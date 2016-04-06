<?php
    class NewsController extends ModuleController
    {
        public $layout_in = 'backend_left_tree_with_buttons';

        private $_active_category_id = null;
        private $_active_category = null;

        public $active_category = null;

        public function init()
        {
            parent::init();

            $this->pageTitleBlock = BackendHelper::htmlTitleBlockDefault('', $this->createUrl('admin/siteManagement'));
            $this->pageTitleBlock .=
                '<div class="img-cont">
                    <a href="'.$this->createUrl("admin/siteManagement").'">
                        <img src="/images/icon-admin/news.png" alt="" title="">
                    </a>
                </div>';
            $this->pageTitleBlock .= '<span class="pull-left title">'.Yii::t('app', 'News, stock, articles').'</span>';

            $this->addButtonsLeftMenu('create',
                array(
                    'url' => $this->createUrl('create_category').'?parent='.$this->_active_category_id
                )
            );
        }

        public function actionIndex()
        {
            $count = (!empty($_COOKIE['count'])) ? $_COOKIE['count'] : 10;
            $model = new News();
            $this->render('all_products', array('model' => $model, 'count' => $count));
        }

        public static function getModuleName()
        {
            return Yii::t('app', 'News');
        }

        public function actionProducts($category_id)
        {
            $this->_active_category_id = $category_id;

            if(!$this->_active_category_id || !($this->_active_category = NewsTree::model()->findByPk($this->_active_category_id)))
                throw new CHttpException('404');

            $this->addButtonsLeftMenu('create', array(
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
                $this->addButtonsLeftMenu('active',
                    array(
                        'url' => $this->createUrl('tree_status').'?id='.$this->_active_category_id,
                        'active' => (NewsTree::model()->findByPk( $this->_active_category_id)->status == NewsTree::STATUS_OK) ? true : false,
                    )
                );
            }

            $count = (!empty($_COOKIE['count'])) ? $_COOKIE['count'] : 10;
            $this->render('products', array('model' => News::model()->notDeleted()->parent($this->_active_category_id), 'category_id' => $category_id, 'count' => $count));
        }

        public function actions()
        {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                ),
                'create_category' => array(
                    'class' => 'actionsBackend.Nested.NestedMultiRootUpdateAction',
                    'Model' => 'NewsTree',
                    'scenario' => 'insert',
                    'View' => 'category'
                ),
                'update_category' => array(
                    'class' => 'actionsBackend.Nested.NestedMultiRootUpdateAction',
                    'Model' => 'NewsTree',
                    'scenario' => 'update',
                    'View' => 'category'
                ),
                'delete_category' => array(
                    'class' => 'actionsBackend.Nested.NestedDeleteAction',
                    'Model' => 'NewsTree',
                    'scenario' => 'update',
                ),
                'up_category'=>array(
                    'class'=>'actionsBackend.Nested.NestedUpAction',
                    'Model'=>'NewsTree',
                ),
                'down_category'=>array(
                    'class'=>'actionsBackend.Nested.NestedDownAction',
                    'Model'=>'NewsTree',
                ),
                'tree_update'=>array(
                    'class'=>'actionsBackend.Nested.NestedMoveTreeAction',
                    'Model'=>'NewsTree',
                ),
                'tree_status'=>array(
                    'class'=>'actionsBackend.Nested.NestedActiveAction',
                    'Model'=>'NewsTree',
                ),
                'upload' => 'actionsBackend.UploadAction',
                'create_product'=>array(
                    'class'=>'actionsBackend.News.NewsUpdateAction',
                    'scenario'=>'insert',
                    'Model'=>'News',
                    'View'=>'product'
                ),
                'update'=>array(
                    'class'=>'actionsBackend.News.NewsUpdateAction',
                    'scenario'=>'update',
                    'Model'=>'News',
                    'View'=>'product'
                ),
                'delete' => array(
                    'class'=>'actionsBackend.DeleteAction',
                    'Model'=>'News',
                    'scenario'=>'update_status'
                ),
                'settings'=>array('class'=>'actionsBackend.SettingsAction'),

                'products_sort'=> array(
                    'class'=>'actionsBackend.Tree.SortAction',
                    'Model'=>'News',
                ),
                'copy_product'=> array(
                    'class'=>'actionsBackend.Tree.CopyMoveAction',
                    'Model'=>'News',
                ),
                'status_products'=> array(
                    'class'=>'actionsBackend.Tree.StatusAction',
                    'Model'=>'News',
                ),
                'update_status'=>array(
                    'class'=>'actionsBackend.ActiveAction',
                    'Model'=>'News',
                    'View'=>'product',
                    'scenario'=>'update_status'
                ),
            );
        }

        public function getLeftMenu()
        {
            if(!$this->_active_category && $this->_active_category_id)
            {
                $this->_active_category = NewsTree::model()->findByPk($this->_active_category_id);
            }

            $model = new NewsTree();
            $categories = $model::getAllTree($this->getCurrentLanguage()->id);
            return array_merge(
                array(
                    array(
                        'text' => CHtml::link('<img class="root-folder-orange" src="/images/icon-admin/folder-orange.png"><span>'.
                        Yii::t('app','Create root category').'</span>', array('create_category')), 'children' => array()
                    )
                ),
                NestedSetHelper::nestedToTreeViewWithOptions($categories, 'id', $this->getTreeOptions(), $this->_active_category_id)
            );
        }

        public function getTreeOptions()
        {
            return array(
                array('catalog_icon' => 'icon', 'title' => 'title', 'url' => $this->createUrl('products').'?category_id='),
            );
        }

        public function getLeftMenuModal()
        {
            if(!$this->_active_category && $this->_active_category_id)
            {
                $this->_active_category = NewsTree::model()->findByPk($this->_active_category_id);
            }

            $model = new NewsTree();

            $categories = $model::getAllTree($this->getCurrentLanguage()->id);
            return array_merge(
                array(
                    array(
                        'text' => CHtml::link('<img class="root-folder-orange" src="/images/icon-admin/folder-orange.png"><span>'.
                        Yii::t('app','Create root category').'</span>', array('create_category')), 'children' => array()
                    )
                ),
                NestedSetHelper::nestedToTreeViewWithOptions($categories,'id',$this->getTreeOptionsModal())
            );
        }

        public function getTreeOptionsModal()
        {
            return array(
                array('catalog_icon' => 'icon', 'title' => 'title', 'url' => '', 'data-id' => '')
            );
        }

        /**
         * @return null
         */

        public function getActiveCategoryId()
        {
            return $this->_active_category_id;
        }

        /**
         * @param null $active_category_id
         */

        public function setActiveCategoryId($active_category_id)
        {
            $this->_active_category_id = $active_category_id;
        }

        public static function getActionsConfig()
        {
            return array(
                'index'             => array('label' => Yii::t('app', 'News, stock, articles'), 'parent'=>'main_modules'),
                'products'          => array('label' => Yii::t('app', 'News, stock, articles'), 'parent'=>'index'),
                'update'            => array('label' => Yii::t('app', 'News, stock, articles'), 'parent'=>'products'),
                'create_category'   => array('label' => Yii::t('app', 'Create a new category'), 'parent'=>'products'),
                'create_product'    => array('label' => Yii::t('app', 'News, stock, articles'), 'parent'=>'products'),
                'update_category'   => array('label' => Yii::t('app', 'Update category'), 'parent' => 'products'),
            );
        }
    }