<?php
    class CatalogController extends FrontendController
    {
        public $root_id;
        public $currency_byn;
        public $currency_eur;
        public $currency_usd;

        public function init()
        {
            parent::init();

            $this->currency_byn = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'BYN'));
            $this->currency_eur = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'EUR'));
            $this->currency_usd = SettingsCurrency::model()->findByAttributes(array('currency_name' => 'USD'));

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
            $count_item = '';

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

            $count_item = Yii::app()->request->cookies['count_item'];

            if(!isset($count_item->value))
            {
                $count_item = 6;
            }
            else
            {
                $count_item = $count_item->value;
            }

            if (!$sort || $sort == '')
            {
                $order = 't.`sort`';
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

            if($root->id == Yii::app()->params['tema_catalog'])
            {
                $count_item = CatalogProducts::model()->active()->count("parent_id = :id", array('id' => $root->id));
            }

            if(!$categories)
            {
                $products = CatalogProducts::model()->getDataProviderForCategory($root->id, $order, $count_item, 1);
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

                    if(isset($_GET['country']) && $_GET['country'])
                    {
                        $id_country = CatalogTree::model()->active()->findByPk(CHtml::encode($_GET['country']));
                        if($id_country)
                        {
                            $list = $id_country->id;
                        }
                    }

                    $products = CatalogProducts::model()->getDataProviderForCategory($list, $order);
                    $count = $products->getTotalItemCount();
                }
                else
                {
                    $this->layout = 'frontend_two_columns';
                    $view = 'countrys';
                }

                $categories = $root->children()->active()->findAll(array('order' => 'title'));
                $this->render($view, array('categories' => $categories, 'root' => $root, 'popular' => $popular, 'dataProducts' => $products, 'sort' => $sort));
                Yii::app()->end();
            }

            $view = ($this->page_id == Yii::app()->params['pages']['hot-avia']) ? 'hot-avia' : 'tree';

            if($root->id == Yii::app()->params['tema_catalog'])
            {
                $view = 'tema_tours';
//                $count_item = null;
            }

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

            $products = new CActiveDataProvider($model,
                array(
                    'criteria' => $criteria,
                    'pagination' => array(),
                )
            );

            $this->render('tree', array('children' => array(), 'dataProducts' => $products, 'category' => array()));
        }

        public function actionTree($url)
        {
            if(isset($_POST['VizaForm']))
            {
                $vizaForm = new VizaForm();
                $vizaForm->attributes = $_POST['VizaForm'];

                if ($vizaForm->validate())
                {
                    $bodyEmail = $this->renderEmail('vizaForm', array('model' => $vizaForm));
                    $mail=Yii::app()->mailer->isHtml(true)->setFrom($vizaForm->email);
                    $mail->send($this->settings->email_order, 'Заказ визы', $bodyEmail);

                    Yii::app()->user->setFlash('modalReview', array('header' => 'Виза успешно заказана', 'content' => 'Вы успешно заказали визу. Мы свяжемся с вами и объясним дальшейшие действия.'));
                    $this->refresh();
                }
            }

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

                    if(isset($_POST['CatalogProductsReviews']))
                    {
                        $pagesize = 3;

                        $new_review = new CatalogProductsReviews();

                        $new_review->attributes = $_POST['CatalogProductsReviews'];
                        if($new_review->validate())
                        {
                            Yii::app()->user->setFlash('modalReview', array('header' => 'Спасибо за отзыв', 'content' => 'Ваш отзыв будет опубликован после проверки администратором.'));
                            $new_review->status = CatalogProductsReviews::STATUS_NEW;

                            $bodyEmail = $this->renderEmail('new_review_product', array('product' => $product));
                            $mail=Yii::app()->mailer->isHtml(true)->setFrom($new_review->email);
                            $mail->send($this->settings->email_callback, 'Отзыв о туре', $bodyEmail);

                            $new_review->save();
                            $this->refresh();
                        }
                    }

                    $this->getPageModule('product');

                    if (!empty($path['breadcrumbs'])) //добавить последний уровень крошек
                    {
                        $this->setBreadcrumbs($path['breadcrumbs'], 'catalog/tree');
                        $temp = array_pop($path['breadcrumbs']);
                        $this->breadcrumbs[$temp['title']] = '/'.$this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']).'/'.$temp['url'];
                    }
                    $this->breadcrumbs[]=$product->title;
                    $this->setPageTitle($product->title);
                    $this->setSeoTags($product);
                    $this->setText($product);

                    if(in_array(Yii::app()->params['pages']['visy'], array($this->page_id, $parent_id)))
                    {
                        $view = 'viza_product';
                        $this->layout = 'frontend';
                    }
                    else
                    {
                        $this->layout = 'frontend';
                        $view = 'product';
                    }
                    $reviews = new CatalogProductsReviews();
                    $reviews_item = $reviews->getDataProviderForReview($product->id);

                    $this->render($view, array('reviews_item' => $reviews_item, 'reviews' => $reviews, 'product' => $product, 'tree' => $tree));
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
                    $order = 't.`sort`';
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
                $this->layout = 'frontend';
                $hots = CatalogProducts::model()->getHotsTours($id);
            }
            else
            {
                $view = 'tree';
                $hots = array();
            }

            $this->render($view,
                array(
                    'trees' => $trees,
                    'dataProducts' => $products,
                    'tree'=>$tree,
                    'count' => $count,
                    'sort' => $sort,
                    'hots' => $hots
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