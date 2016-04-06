<?php

Yii::import('bootstrap.widgets.BsListView');

class ProductListView extends BsListView
{
    public $typeCatalog='small';

    public function renderMainItems()
    {
        if ($this->dataProvider->getItemCount()>0)
        {
            echo '<div class="type-catalog">
            <a href="?type=small" class="'.($this->typeCatalog=='small'?'active':"").'"><span class="glyphicon glyphicon-list"></span> Кратко</a>
            <a href="?type=full" class="'.($this->typeCatalog=='full'?'active':"").'"><span class="glyphicon glyphicon-align-justify"></span> Подробно</a>
        </div><div class="clearfix"></div>';

            switch($this->typeCatalog)
            {
                case 'small':
                    echo '<div class="row header">
                            <div class="col-xs-1">№</div>
                            <div class="col-xs-1">Артикул</div>
                            <div class="col-xs-4">Наименование</div>
                            <div class="col-xs-2">Цена</div>
                            <div class="col-xs-2">Наличие</div>
                            <div class="col-xs-2"></div>
                        </div>';
                    break;
                case 'full':
                    echo '<div class="row header">
                            <div class="col-xs-8">Наименование</div>
                            <div class="col-xs-4"></div>
                        </div>';
                    break;
            }

            parent::renderItems();
        }
    }

    public function renderMainSorter()
    {
        $count=$this->dataProvider->getItemCount();
        if ($count>0)
        {
            $cs=Yii::app()->getClientScript();
            $sorter='
                    $("body").on("change","#sort-main",function()
                    {
                        $.cookie("sort_products",$(this).val(),{expires: 3600, path: "/"});
                        window.location.reload();
                    });
                ';
            $cs->registerPackage("cookie")->registerScript('sorter',$sorter);

            echo 'Сортировать: '.CHtml::dropDownList('sort-main',$this->sorter,array('price_asc'=>'Сначало дешевые','price_desc'=>'Сначало дорогие','title_asc'=>'А-Я','title_desc'=>'Я-А'),array('prompt'=>'---'));;
        }
    }

    public function renderCounter()
    {
        $count=$this->dataProvider->getItemCount();
        if ($count>0)
        {
            $cs=Yii::app()->getClientScript();
            $counter='
                    $("body").on("change","#count-main",function()
                    {
                        $.cookie("count",$(this).val(),{expires: 3600, path: "/"});
                        window.location.reload();
                    });
                ';
            $cs->registerPackage("cookie")->registerScript('counter',$counter);

            echo 'На старнице: '.CHtml::dropDownList('count-main',$this->counter,array('10'=>'10','20'=>'20','40'=>'40','50'=>'50'));
        }
    }
}
