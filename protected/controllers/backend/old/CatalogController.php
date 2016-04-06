<?php
    class CatalogController extends ModuleController
    {
        public $layout_in = 'backend_left_tree_with_buttons';

        private $_active_category_id = null;
        private $_active_category = null;

        public $active_category = null;

        public function init()
        {
            parent::init();

            $this->pageTitleBlock = BackendHelper::htmlTitleBlockDefault('', $this->createUrl('admin/'));
            $this->pageTitleBlock .=
                '<div class="img-cont">
                    <a href="'.$this->createUrl("admin/").'">
                        <img src="/images/icon-admin/catalog.png" alt="" title="">
                    </a>
                </div>';
            $this->pageTitleBlock .= '<span class="pull-left title">'.Yii::t('app', 'Catalog').'</span>';

            $this->addButtonsLeftMenu('create', array(
                    'url'=>$this->createUrl('create_category').'?parent='.$this->_active_category_id
                )
            );
        }

        public function filters()
        {
            return array_merge(
                parent::filters(),
                array('ajaxOnly + treeUpdate, search')
            );
        }

        public static function getModuleName()
        {
            return Yii::t('app', 'Catalog');
        }

        public function actions()
        {
            return array(
                'create_category' => array(
                    'class' => 'actionsBackend.Nested.NestedMultiRootUpdateAction',
                    'Model' => 'CatalogTree',
                    'scenario' => 'insert',
                    'View' => 'category'
                ),
                'update_category' => array(
                    'class' => 'actionsBackend.Nested.NestedMultiRootUpdateAction',
                    'Model' => 'CatalogTree',
                    'scenario' => 'update',
                    'View' => 'category'
                ),
                'delete_category' => array(
                    'class' => 'actionsBackend.Nested.NestedDeleteAction',
                    'Model' => 'CatalogTree',
                    'scenario' => 'update',
                ),
                'up_category' => array(
                    'class' => 'actionsBackend.Nested.NestedUpAction',
                    'Model' => 'CatalogTree',
                ),
                'down_category' => array(
                    'class' => 'actionsBackend.Nested.NestedDownAction',
                    'Model' => 'CatalogTree',
                ),
                'tree_update' => array(
                    'class' => 'actionsBackend.Nested.NestedMoveTreeAction',
                    'Model' => 'CatalogTree',
                ),
                'tree_status' => array(
                    'class' => 'actionsBackend.Nested.NestedActiveAction',
                    'Model' => 'CatalogTree',
                ),
                'upload' => 'actionsBackend.UploadAction',
                'create_product' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductUpdateAction',
                    'scenario' => 'insert',
                    'Model' => 'CatalogProducts',
                    'View' => 'product'
                ),
                'update_product' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductUpdateAction',
                    'scenario' => 'update',
                    'Model' => 'CatalogProducts',
                    'View' => 'product'
                ),
                'delete_product' => array(
                    'class' => 'actionsBackend.DeleteAction',
                    'Model' => 'CatalogProducts',
                ),
                'settings' => array('class' => 'actionsBackend.SettingsAction'),
                'products_sort' => array(
                    'class' => 'actionsBackend.Tree.SortAction',
                    'Model' => 'CatalogProducts',
                ),
                'params_sort' => array(
                    'class' => 'actionsBackend.Catalog.ParamsSortAction',
                    'Model' => 'CatalogParams',
                ),
                'copy_product' => array(
                    'class' => 'actionsBackend.Tree.CopyMoveAction',
                    'Model' => 'CatalogProducts',
                ),
                'status_products' => array(
                    'class' => 'actionsBackend.Tree.StatusAction',
                    'Model' => 'CatalogProducts',
                ),
                'active' => array(
                    'class' => 'actionsBackend.ActiveAction',
                    'Model' => 'CatalogProducts',
                ),
                'products_releated_save' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductsReleatedSaveAction',
                    'Model' => 'ProductsReleated',
                ),
                'products_releated_delete' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductsReleatedDeleteAction',
                    'Model' => 'ProductsReleated',
                ),
                'products_releated_select' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductsReleatedSelectAction',
                    'Model' => 'ProductsReleated',
                ),
                'releated_sort' => array(
                    'class' => 'actionsBackend.Catalog.CatalogProductsReleatedSortAction',
                    'Model' => 'ProductsReleated',
                ),
            );
        }

        public function actionIndex()
        {
            $count = (!empty($_COOKIE['count'])) ? $_COOKIE['count'] : 10;
            $model = new CatalogProducts();
            $this->render('all_products', array('model' => $model, 'count' => $count));
        }

        public function actionTreeParams($tree_id)
        {
            $refresh = false;

            $tree = CatalogTree::model()->findByPk($tree_id);

            if ($tree === null)
            {
                throw new CHttpException(404);
            }

            $params = $this->getParamsForTree($tree);

            $forms = array();

            $post_params = array();

            if (!empty($_POST))
            {
                $refresh = true;

                if (!empty($_POST['CatalogParams']))
                {
                    $post_catalog = $_POST['CatalogParams'];
                }
                else
                {
                    $post_catalog = array();
                }

                foreach ($post_catalog as $key => $post)
                {
                    $validate = true;

                    //type form

                    if ($post['type'] == 0)
                    {
                        $type = '_parent';
                    }
                    else
                    {
                        $type = '_child';
                    }

                    if(is_numeric($key))
                    {
                        if(isset($params[$key]) && $params[$key]->catalog_tree_id==$tree->id &&
                        ($params[$key]->title!=$post['title']
                        || $params[$key]->type!=$post['type']
                        || (isset($post['unit']) && $params[$key]->unit!=$post['unit'])
                        || (isset($post['status']) && $params[$key]->status!=$post['status'])
                        ))
                        {
                            $params[$key]->title = $post['title'];
                            $params[$key]->type = $post['type'];
                            $params[$key]->unit = $post['unit'];
                            $params[$key]->status = $post['status'];
                            $params[$key]->scenario = 'update'.$type;

                            if ($params[$key]->validate())
                            {
                                $params[$key]->save(false);
                            }
                            else
                            {
                                $refresh=false;
                            }
                        }

                        $forms[]=$params[$key];
                        $item_params=$params[$key]; //текущий параметр- нужен для сохранения значений
                        unset($params[$key]);
                    }
                    else
                    {
                        $catalog_params=new CatalogParams();
                        $catalog_params->scenario = 'insert'.$type;
                        $catalog_params->attributes=$post;
                        $catalog_params->catalog_tree_id=$tree->id;

                        if(!isset($post['parent_id']))
                        {
                            $parent = NULL;
                            $catalog_params->unit = 0;
                            $catalog_params->parent_id = $parent;
                        }

                        $criteria  = new CDbCriteria();
                        $criteria->select = new CDbExpression(' MAX(`sort`) AS `sort` ');
                        $criteria->condition = '`parent_id`=:parent_id';
                        $criteria->params = array(':parent_id'=>$catalog_params->parent_id);
                        $max_sort = $catalog_params->find($criteria);
                        $catalog_params->sort = (!$max_sort->sort) ? 1 : $max_sort->sort + 1;

                        if ($validate && $catalog_params->validate())
                        {
                            $catalog_params->save(false);
                        }
                        else
                        {
                            $catalog_params->id=$key;
                            $refresh=false;
                        }

                        $forms[]=$catalog_params;
                        $item_params=$catalog_params;

                        $post_params[$key]=$catalog_params->id;
                    }


                    //разбор вложенных значений
                    if ($item_params->catalog_tree_id==$tree->id)//пепребираем значения только для актуальной каатегории
                    {
                        $ret_values=array(); //результирующий массив значений параметра

                        $values=$item_params->getValues();
                        if($values)
                        {
                            $values = array_combine(CHtml::listData($values,'id','id'),$values);
                        }

                        if (isset($_POST['CatalogParamsVal'][$key]['values']) && $item_params->type>$item_params::TYPE_YES_NO)
                        {
                            $post_values=$_POST['CatalogParamsVal'][$key]['values'];
                        }
                        else
                        {
                            $post_values=array();
                        }

                        foreach ($post_values as $pv_key=>$post_value)
                        {
                            if(is_numeric($pv_key))
                            {
                                if(isset($values[$pv_key]) && ($values[$pv_key]->value!=$post_value['value']))
                                {
                                    $values[$pv_key]->value = $post_value['value'];
                                    $values[$pv_key]->scenario = 'update';
                                    $values[$pv_key]->save();
                                }

                                $ret_values[]=$values[$pv_key];
                                unset($values[$pv_key]);
                            }
                            else
                            {
                                $params_value= new CatalogParamsVal();
                                $params_value->attributes=$post_value;
                                $params_value->params_id = $item_params->id;
                                if (!$item_params->isNewRecord && $params_value->validate())
                                {
                                    $params_value->save(false);
                                }
                                else
                                {
                                    $refresh=false;
                                }
                                $ret_values[]=$params_value;
                            }
                        }

                        //засовываем результрующий массив в модель параметра

                        $item_params->setValues($ret_values);

                        foreach ($values as $del)
                        {
                            $del->delete();
                        }
                    }
                }


                foreach ($params as $del)
                {
                    if ($del->catalog_tree_id==$tree->id)
                    {
                        $del->delete();
                    }
                }
                if(!empty($params))
                {
                    foreach ($params as $del)
                    {
                        $del->delete();
                    }
                }
            }
            else
            {
                $forms = $params;
            }

            if ($refresh)
            {
                $this->refresh();
            }

            $model = new CatalogParams();

            $this->render('tree_params', array('forms' => $forms, 'model' => $model, 'tree_id' => $tree->id));
        }

        public function actionProducts($category_id)
        {
            $this->_active_category_id = $category_id;

            if(! $this->_active_category_id || !($this->_active_category = CatalogTree::model()->findByPk( $this->_active_category_id)))
            {
                throw new CHttpException('404');
            }

            $this->addButtonsLeftMenu('create',
                array(
                    'url' => $this->createUrl('create_category').'?parent='.$this->_active_category_id
                )
            );

            if($this->_active_category_id)
            {
                $this->addButtonsLeftMenu('update',
                    array(
                        'url' => $this->createUrl('update_category').'?id='.$this->_active_category_id
                    )
                );
                $this->addButtonsLeftMenu('delete',
                    array(
                        'url' => $this->createUrl('delete_category').'?id='.$this->_active_category_id
                    )
                );
                $this->addButtonsLeftMenu('parameters',
                    array(
                        'url' => $this->createUrl('treeParams').'?tree_id='.$this->_active_category_id
                    )
                );
                $this->addButtonsLeftMenu('active',
                    array(
                        'url' => $this->createUrl('tree_status').'?id='.$this->_active_category_id,
                        'active' => (CatalogTree::model()->findByPk( $this->_active_category_id)->status == CatalogTree::STATUS_OK) ? true : false,
                    )
                );
            }

            $count = (!empty($_COOKIE['count'])) ? $_COOKIE['count'] : 10;
            $this->render('products', array('model' => CatalogProducts::model()->notDeleted()->parent($this->_active_category_id), 'category_id' => $category_id, 'count' => $count));
        }


        public function getLeftMenu()
        {
            if(!$this->_active_category && $this->_active_category_id)
            {
                $this->_active_category = CatalogTree::model()->findByPk($this->_active_category_id);
            }

            $model = new CatalogTree();

            $categories = $model::getAllTree($this->getCurrentLanguage()->id);
            return array_merge(
                array(
                    array(
                        'text' => CHtml::link('<img class="root-folder-orange" src="/images/icon-admin/folder-orange.png"><span>'.
                        Yii::t('app','Create root category').'</span>', array('create_category')), 'children' => array()
                    )
                ),
                NestedSetHelper::nestedToTreeViewWithOptions($categories,'id',$this->getTreeOptions(),$this->_active_category_id)
            );
        }

        public function getParamsForTree($tree)
        {
            $tree_ids = CHtml::listData($tree->parent()->findAll(), 'id', 'id'); //id родительских узлов

            $tree_ids[] = $tree->id; //сам узел

            $params = CatalogParams::getTreeParams($tree_ids);

            if($params)
            {
                $params = array_combine(CHtml::listData($params, 'id', 'id'), $params);
            }

            return $params;
        }

        public function getTreeOptions()
        {
            return array(
                array('catalog_icon'=>'icon','title'=>'title','url'=>$this->createUrl('products').'?category_id='),
            );
        }

        public static function getActionsConfig()
        {
            return array(
                'index' => array('label' => static::getModuleName(),'parent' => 'main_catalog'),
                'list' => array('label' => Yii::t('app', 'List'), 'parent' => 'index'),
                'view' => array('label' => Yii::t('app', 'View'), 'parent' => 'index'),
                'create_category' => array('label' => Yii::t('app', 'Create'),'parent' => 'index'),
                'update_category' => array('label' => Yii::t('app', 'Update'),'parent' => 'index'),
                'treeparams' => array('label' => Yii::t('app', 'Update'), 'parent' => 'index'),
                'products' => array('label' => Yii::t('app', 'Update'),'parent' => 'index'),
                'create_product' => array('label' => Yii::t('app', 'Update'), 'parent' => 'index'),
                'update_product' => array('label' => Yii::t('app', 'Update'), 'parent' => 'index'),
                'settings' => array('label' => Yii::t('app', 'Settings'). ' ' .static::getModuleName(), 'parent' => 'settings/index'),
            );
        }

        public function actionLoadPrice()
        {
            if (!empty($_POST) && !empty($_POST['file']))
            {
                $parser=Yii::app()->priceParser;

                $parser->parseCsv($_POST['file']);
            }

            $this->render('load_price');
        }

        public function actionDownloadPrice()
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=price.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $content=Yii::app()->priceParser->getCsv();
            header('Content-Length: ' . strlen($content));
            echo iconv('utf-8','windows-1251',$content);
        }

        public function actionSearch($term)
        {
            $words = explode(' ', $term);

            $criteria = new CDbCriteria;

            if (!empty($words))
            {
                $count = count($words);
                for ($i = 0; $i < $count; $i++)
                {
                    $criteria->addSearchCondition('title', $words[$i]);
                    $criteria->addSearchCondition('article', $words[$i], true, 'OR');
                }
            }

            $criteria->scopes = array(
                'language' => array($this->getCurrentLanguage()->id),
                'active',
            );

            $model = new CatalogProducts();

            $criteria->limit = 5;

            $links = $model::model()->findAll($criteria);

            $result = array();
            foreach($links as $link)
            {
                $image = $link->getOneFile('small');
                if (!$image)
                {
                    $image = Yii::app()->params['noimage'];
                }

                $result[] = array(
                    'src' => $image,
                    'article' => $link->article,
                    'title' => $link->title,
                    'price' => $link->price,
                    'label' => $link->title,  // label for dropdown list
                    'value' => $term,  // value for input field
                    'id' => $link->id,        // return value from autocomplete
                );
            }
            echo CJSON::encode($result);
        }

        public function getLeftMenuModal()
        {
            if(!$this->_active_category && $this->_active_category_id)
            {
                $this->_active_category = CatalogTree::model()->findByPk($this->_active_category_id);
            }

            $model = new CatalogTree();

            $categories = $model::getAllTree($this->getCurrentLanguage()->id);
            return array_merge(
                array(
                    array(
                        'text' => CHtml::link('<img class="root-folder-orange" src="/images/icon-admin/folder-orange.png"><span>'.
                        Yii::t('app','Create root category').'</span>', array('create_category')), 'children' => array()
                    )
                ),
                NestedSetHelper::nestedToTreeViewWithOptions($categories, 'id', $this->getTreeOptionsModal())
            );
        }

        public function getTreeOptionsModal()
        {
            return array(
                array('catalog_icon' => 'icon', 'title' => 'title', 'url' => '', 'data-id' => '')
            );
        }

        public function setActiveCategoryId($active_category_id)
        {
            $this->_active_category_id = $active_category_id;
        }
    }