<?php
	$parameters = CatalogProductsParams::model()->findAll(array('condition' => 'product_id = :id', 'params' => array(':id' => $data->id)));
	if($parameters)
	{
		echo '<tr>';

		foreach($parameters as $value)
		{
			echo '<td>'.$value->value['value'].'</td>';
		}

		echo '<td><a href = "">Заказать</a></td>';
		echo '</tr>';
	}