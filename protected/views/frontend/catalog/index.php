<?php
    foreach($categories as $item)
    {
        echo CHtml::link($item->title,array('catalog/tree', 'url' => $item->name)).'<br>';
    }