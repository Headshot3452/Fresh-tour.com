<?php
    class StructureController extends ModuleController
    {
        public $layout_in = 'backend_left_tree';

        protected $_categories = array();

        public $_active_category_id = null;
        public $_active_category = null;

        public $active_category = null;

        public function filters()
        {
            return array_merge(
                      parent::filters(),
                      array('ajaxOnly + treeUpdate')
            );
        }

        public static function getModuleName()
        {
            return Yii::t('app', 'Structure');
        }

        public function actions()
        {
            $actions = parent::actions();
            return CMap::mergeArray($actions,
                array(
                    'index' => array(
                        'class' => 'actionsBackend.Structure.NestedUpdateAction',
                        'scenario' => 'insert',
                        'View' => 'create',
                    ),
                    'create' => array(
                        'class' => 'actionsBackend.Structure.NestedUpdateAction',
                        'scenario' => 'insert',
                    ),
                    'update' => array(
                        'class' => 'actionsBackend.Structure.NestedUpdateAction',
                        'scenario' => 'update',
                    ),
                    'upload' => 'actionsBackend.UploadAction',
                    'up' => array(
                        'class' => 'actionsBackend.Nested.NestedUpAction',
                        'scenario' => 'update',
                    ),
                    'down'=>array(
                        'class' => 'actionsBackend.Nested.NestedDownAction',
                        'scenario' => 'update',
                    ),
                    'tree_update' => array(
                        'class' => 'actionsBackend.Nested.NestedMoveTreeAction',
                    ),
                    'active' => array(
                        'class' => 'actionsBackend.Nested.NestedActiveAction',
                    ),
                    'delete' => array(
                        'class' => 'actionsBackend.Nested.NestedDeleteAction',
                    ),
                )
            );
        }

        protected function beforeRender($view)
        {
            if(!parent::beforeRender($view))
            {
                return false;
            }

            $this->pageTitleBlock = BackendHelper::htmlTitleBlockDefault('', $this->createUrl('admin/siteManagement'));
            $this->pageTitleBlock .=
                                '<div class="img-cont">
                                    <a href="'.$this->createUrl("admin/siteManagement").'">
                                        <img src="/images/icon-admin/structure.png" alt="" title="">
                                    </a>
                                </div>';
            $this->pageTitleBlock .= '<span class="pull-left title">'.Yii::t('app', 'Structure').'</span>';

            return true;
        }

        public function getLeftMenu()
        {
            $categories = $this->getCategories();

            if(!$this->_active_category && $this->_active_category_id)
            {
                $this->_active_category = Structure::model()->findByPk($this->_active_category_id);
            }
            return array_merge(
                NestedSetHelper::nestedToTreeViewWithOptions($categories, 'id', $this->getTreeOptions(), $this->_active_category_id)
            );
        }

        public function getCategories()
        {
            if (empty($this->_categories))
            {
                $this->_categories = Structure::getTreeForMenu($this->getCurrentLanguage()->id);
            }
            return $this->_categories;
        }

        public function getTreeOptions()
        {
            return array(
                array('icon'=>'icon', 'title'=>'title', 'url' => $this->createUrl('update').'?id='),
            );
        }
    }