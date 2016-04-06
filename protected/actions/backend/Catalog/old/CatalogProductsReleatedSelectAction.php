<?php
    class CatalogProductsReleatedSelectAction extends BackendAction
    {
        public function run()
        {
            $category_id = $_POST['category_id'];
            $product_id = $_POST['product_id'];
            $releated_products = ProductsReleated::getReleatedProducts($product_id);
            $keys_array = array();
            foreach ($releated_products as $value)
            {
                $keys_array[] = $value->releated_id;
            }
            $criteria = new CDbCriteria();
            $criteria->condition = '`parent_id` = :parent_id AND `id`<>:product_id ';
            $criteria->params = array(':parent_id' => $category_id, ':product_id' => $product_id);
            if(!empty($keys_array))
            {
                $criteria->addNotInCondition('id', $keys_array);
            }
            $count = CatalogProducts::model()->notDeleted()->findAll($criteria);
            $this->renderPartial('_products_releated_select', array('model' => CatalogProducts::model()->notDeleted()->onlyOneParent($category_id, $product_id, $keys_array), 'category_id'=>$category_id, 'count' => count($count)));
        }
    }
