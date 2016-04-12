<?php
    if (!isset($url))
    {
        $url = '';
    }

    if (isset($trees))
    {
        echo '<div class="trees">';
        if (isset($tree))
        {
            $url = $tree->findUrlForItem('name',false,$this->root_id) . $tree->name . '/';
        }
        foreach($trees as $key => $item)
        {
            $image = Yii::app()->params['noimage'];

            $link=$this->createUrl('catalog/tree',array('url' => $url.$item->name));
            echo '<div class="item">';
                echo '<div class="image"><a href="'.$link.'"><img src="/'.$image.'" class="img-responsive"></a></div>';
                echo '<div class="title text-center">'.CHtml::link($item->title,$link).'</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    if (isset($dataProducts) && !empty($dataProducts))
    {
        $itemView = '_item_product';
        $typeCatalog = 'small';

        switch(Yii::app()->request->cookies['type_catalog'])
        {
            case 'full':
                $itemView = '_item_product_full';
                $typeCatalog = 'full';
                break;
        }

        $count = $dataProducts->getItemCount();

        echo
            '<h1>'. $this->pageTitle . '<i> '.$count.'</i> </h1>
            <div class="sort">
                Сортировка по: <a href = "" class="'.$sort.'">Цене <span></span> </a>
            </div>
            <div class="row">';

        if ($count > 0)
        {
            $cs = Yii::app()->getClientScript();
            $sorter = '
                $("body").on("click", ".sort a", function()
                {
                    if($(this).hasClass("price_asc"))
                    {
                        $.cookie("sort_products", "price_desc", {expires: 3600, path: "/"});
                    }
                    else if($(this).hasClass("price_desc"))
                    {
                        $.cookie("sort_products", "price_asc", {expires: 3600, path: "/"});
                    }
                    window.location.reload();
                });
            ';
            $cs->registerPackage("cookie")->registerScript('sorter', $sorter);
        }

        $counter = '<div id="count">
                        Показывать по <a href = "" >6</a> строк
			        </div>';


        $this->widget('application.widgets.ProductListView',
            array(
                'id' => 'products-list',
                'htmlOptions' => array(
                    'class' => $typeCatalog
                ),
                'typeCatalog' => $typeCatalog,
                'itemView' => $itemView,
                'dataProvider' => $dataProducts,
                'ajaxUpdate' => false,
                'template' => "{items}\n<div class=\"col-xs-12 text-center\">{pager}$counter</div>",
                'viewData' => array(
                    'url' => $url,
                    'count' => $count
                ),
                'pager' => array(
                    'class' => 'bootstrap.widgets.BsPager',
                    'firstPageLabel' => '',
                    'prevPageLabel' => '',
                    'nextPageLabel' => '',
                    'lastPageLabel' => '',
                    'hideFirstAndLast' => true,
                )
            )
        );

        if(!isset($_GET['page']))
        {
            echo
                '<div class="text col-xs-12">
                    '.$this->text.'
                </div>';
        }

        echo '</div>';
    }