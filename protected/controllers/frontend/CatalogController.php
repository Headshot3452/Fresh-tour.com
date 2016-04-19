<?php
    class CatalogController extends FrontendController
    {
        public $root_id;

        public function init()
        {
            parent::init();

            $this->getPageModule();
            $struct = Structure::model()->findByPk($this->page_id);
            $this->root_id = $struct->module->tree_id;
        }

        public function actionIndex()
        {
            $this->getPageModule();
            $products = array();
            $count = '';
            $sort = '';

            $child_struct = Structure::model()->active()->findByPk($this->page_id);
            $parent_struct = array();

            if($child_struct)
            {
                $parent_struct = $child_struct->ancestors()->active()->find('level = 2');
            }

            $parent_id = isset($parent_struct->id) ? $parent_struct->id : 0;

            $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->findByPk($this->root_id);

            $categories = $root->children()->active()->findAll();

            $sort = Yii::app()->request->cookies['sort_products'];

            if (!$sort || $sort == '')
            {
                $sort = 'price_asc';
            }
            else
            {
                $sort = $sort->value;
            }

            if (!empty($sort))
            {
                switch($sort)
                {
                    case 'price_asc': $order = 't.`price` ASC'; break;
                    case 'price_desc': $order = 't.`price` DESC'; break;
                }
            }

            if(!$categories)
            {
                $products = CatalogProducts::model()->getDataProviderForCategory($root->id, $order);
                $count = $products->getTotalItemCount();
            }
            else
            {
                $popular = $root->children()->active()->findAll(
                    array(
                        'condition' => 'popular = :popular',
                        'params' => array(':popular' => '1'),
                        'order' => 'lft',
                        'limit' => '9'
                    )
                );

                if(in_array(Yii::app()->params['pages']['hot-tour'], array($this->page_id, $parent_id)))
                {
                    $view = 'hot-tours';
                    $list = CHtml::listData($categories, 'id', 'id');
                    $products = CatalogProducts::model()->getDataProviderForCategory($list, $order);
                    $count = $products->getTotalItemCount();
                }
                else
                {
                    $view = 'countrys';
                }

                $categories = $root->children()->active()->findAll(array('order' => 'title'));
                $this->render($view, array('categories' => $categories, 'popular' => $popular, 'dataProducts' => $products, 'sort' => $sort));
                Yii::app()->end();
            }

            $view = ($this->page_id == Yii::app()->params['pages']['hot-avia']) ? 'hot-avia' : 'tree';

            $this->render($view, array('categories' => $categories, 'dataProducts' => $products, 'count' => $count, 'sort' => $sort));
        }

        public function actionList()
        {

        }

        public function actionSearch($term)
        {
            $this->setPageTitle("Поиск");

            $words = explode(' ',$term);

            $criteria=new CDbCriteria;

            if (!empty($words))
            {
                $count=count($words);
                for ($i=0;$i<$count;$i++)
                {
                    $criteria->addSearchCondition('title',$words[$i]);
                }
            }

            $criteria->scopes=array(
                'language'=>array($this->getCurrentLanguage()->id),
                'active',
            );

            $model = new CatalogProducts();

            if (Yii::app()->request->isAjaxRequest)
            {
                $criteria->limit=5;

                $links=$model::model()->findAll($criteria);

                $result = array();
                foreach($links as $link)
                {
                    $image=$link->getOneFile('small');

                    $result[] = array(
                        'url'=>$this->createUrl('catalog/tree',array('url'=>$link->getUrlForItem($this->root_id))),
                        'src'=>($image) ? $image : Yii::app()->params['noimage'],
                        'label'=>$link->title,  // label for dropdown list
                        'value'=>$term,  // value for input field
                        'id'=>$link->id,        // return value from autocomplete
                    );
                }

                echo CJSON::encode($result);
                Yii::app()->end();
            }

            $products=new CActiveDataProvider($model,
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(),
                )
            );

            $this->render('tree', array('children' => array(), 'dataProducts'=>$products, 'category' => array()));
        }

        public function actionTree($url)
        {
            $pages = explode('/', $url);

            $root = CatalogTree::model()->language($this->getCurrentLanguage()->id)->roots()->active()->findByPk($this->root_id);

            if (!$root)
            {
                throw new CHttpException(404);
            }

            $id = $root->id;

            $count_page = count($pages);

            if ($count_page > 0)
            {
                $path = $root->findPath('name', $pages);

                if (!empty($path['item']))
                {
                    if (!empty($path['active_ids']))
                    {
                        $this->setActiveIds($path['active_ids'],'catalogTree');
                        $this->addActiveId($id,'catalogTree');
                    }

                    $id = $path['item']['id'];
                }
                $tree = $this->getPageTree($id);

                $count_breadcrumbs = count($path['breadcrumbs']);

                $child_struct = Structure::model()->active()->findByPk($this->page_id);

                $parent_id = isset($child_struct->id) ? $child_struct->id : 0;

                if ($count_page > $count_breadcrumbs && ($count_page - 1) == $count_breadcrumbs)
                {
                    $product = CatalogProducts::model()->active()->find('name = :name and parent_id = :parent_id',array(':parent_id' => $id,':name' => $pages[$count_page - 1]));
                    if (!$product)
                    {
                        throw new CHttpException(404);
                    }

                    $this->getPageModule('product');

                    if (!empty($path['breadcrumbs']))//добавить последний уровень крошек
                    {
                        $this->setBreadcrumbs($path['breadcrumbs'], 'catalog/tree');
                        $temp = array_pop($path['breadcrumbs']);
                        $this->breadcrumbs[$temp['title']] = '/'.$this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']).'/'.$temp['url'];
                    }
                    $this->breadcrumbs[]=$product->title;
                    $this->setPageTitle($product->title);
                    $this->setSeoTags($product);
                    $this->setText($product);

                    if(isset($_POST['VizaForm']))
                    {
                        $vizaForm = new VizaForm();
                        $vizaForm->attributes = $_POST['VizaForm'];

                        CActiveForm::validate($vizaForm);

                        if ($vizaForm->validate())
                        {
                            $bodyEmail = $this->renderEmail('contacts',array('model' => $vizaForm));
                            $mail=Yii::app()->mailer->isHtml(true)->setFrom($vizaForm->email);
                            $mail->send($this->settings->email,'Subject', $bodyEmail);
                        }
                    }

                    if(in_array(Yii::app()->params['pages']['visy'], array($this->page_id, $parent_id)))
                    {
                        $view = 'viza_product';
                    }
                    else
                    {
                        $view = 'product';
                    }

                    $this->render($view, array('product' => $product, 'tree' => $tree));
                    Yii::app()->end();
                }
                elseif($count_page != $count_breadcrumbs)
                {
                    throw new CHttpException(404);
                }
            }
            else
            {
                $this->addActiveId($id,'catalogTree');
            }

            $this->getPageModule('tree');

            if (!empty($path['breadcrumbs']))
            {
                $this->setBreadcrumbs($path['breadcrumbs'],'catalog/tree');
            }
            if (isset($tree))
            {
                //type catalog full/small

                $type_catalog=Yii::app()->request->getQuery('type',Yii::app()->request->cookies['type_catalog']);

                if ($type_catalog != '')
                {
                    Yii::app()->request->cookies['type_catalog'] = new CHttpCookie('type_catalog', $type_catalog);
                }

                $order = 't.`price` ASC';
                $sort = Yii::app()->request->cookies['sort_products'];

                if (!$sort)
                {
                    $sort = 'price_asc';
                }
                else
                {
                    $sort = $sort->value;
                }

                if (!empty($sort))
                {
                    switch($sort)
                    {
                        case 'price_asc': $order = 't.`price` ASC'; break;
                        case 'price_desc': $order = 't.`price` DESC'; break;
                    }
                }

                $count = Yii::app()->request->cookies['count'];
                if (!$count)
                {
                    $count = 'default';
                }
                else
                {
                    $count = $count->value;
                }

                switch($count)
                {
                    case 20: $count = 20; break;
                    case 40: $count = 40; break;
                    case 50: $count = 50; break;
                    default:
                        $count = 10;
                        break;
                }

                $trees = $tree->children()->active()->findAll();
                $products = CatalogProducts::model()->getDataProviderForCategory($id, $order, $count);
            }

            if(in_array(Yii::app()->params['pages']['strany-i-oteli'], array($this->page_id, $parent_id)))
            {
                $view = 'country';
            }
            else
            {
                $view = 'tree';
            }

            $this->render($view,
                array(
                    'trees' => $trees,
                    'dataProducts' => $products,
                    'tree'=>$tree,
                    'count' => $count,
                    'sort' => $sort,
                )
            );
        }

        protected function getPageTree($id)
        {
            $this->active_id=$id;
            $page=CatalogTree::model()->findByPk($id);

            $this->breadcrumbs[]=$page->title;

            $this->setPageTitle($page->title);
            $this->setSeoTags($page);
            $this->setText($page);

            return $page;
        }

        public function hasActive($id,$type='catalogTree')
        {
            return parent::hasActive($id,$type);
        }
    }