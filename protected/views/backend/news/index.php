<?php
    /* @var $this NewsController */
    /* @var $model News */

    $header  = '<div class="buttons_group">';
    $header .= '<div class="btn-group checkbox">
                    <button type="button" class="btn checkbox-action">-</button>
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#modal_active" role="button" data-toggle="modal" rel="javascript" class="remove-ip action-ip">Показать</a></li>
                        <li><a href="#modal_not_active" role="button" data-toggle="modal" rel="javascript" class="remove-ip action-ip">Скрыть</a></li>
                        <li><a href="#modal_delete" role="button" data-toggle="modal" rel="javascript" class="remove-ip action-ip">Удалить</a></li>
                    </ul>
                </div>';

    $header .= '<a data-placement="bottom" title="Копировать новость" href="#modal_copy_products" role="button" data-toggle="modal" style="display: none;" class="btn btn-action copy_products"><span class="icon-admin-copy-product"></span></a>';
    $header .= '<a data-placement="bottom" title="Переместить новость" href="#modal_copy_products" role="button" data-toggle="modal" style="display: none;" class="btn btn-action move_products"><span class="icon-admin-move-product"></span></a>';

    $dataProducts = $model->language($this->getCurrentLanguage()->id)->search($count);
    $item_count = $dataProducts->getTotalItemCount();
    $pages = new CPagination($item_count);
    $page_size =  $count;
    $pages->setPageSize($page_size);
    $page_count=ceil($item_count/$page_size);

    if($page_count > 1)
    {
        $header .=
            '<div class="pag-cont news">
                <ul class="pagination">
                    <li><a href="" id="left_page"><i class="fa fa-angle-left"></i>
                        </a>
                    </li>';

        ob_start();
                    $this->widget('CListPager',
                        array(
                            'currentPage' => $pages->getCurrentPage(),
                            'itemCount' => $item_count,
                            'pageSize' => $page_size,
                            'header' => '',
                            'htmlOptions' => array(
                                'class' => 'selectpicker'
                            )
                        )
                    );
        $header .= ob_get_contents();
        ob_clean();

        $header .=
                    '<li>
                        <a href="" id="right_page">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>';
    }

    $header .= '</div>';

    $header_popovers = ' $(".buttons_group .btn-action").tooltip();';
    $cs=Yii::app()->getClientScript();
    $cs->registerScript("header_popovers", $header_popovers);

    $products_sortable = '
        $("#products-list ul").nestedSortable(
        {
            items: "li",
            listType: "ul",
            tabSize : 15,
            maxLevels: 0,

            update:function( event, ui )
            {
                $.ajax(
                {
                    type: "POST",
                    url: "'.$this->createUrl("products_sort").'",
                    data:
                    {
                        id: $(ui.item).attr("id"),
                        index: $(ui.item).index(),
                    },
                    success: function(data)
                    {
                        console.log(data);
                    }
                });
            }
        });';

    $cs->registerScript("products_sortable", $products_sortable);

    $typeCatalog = 'small';

    $this->widget('application.widgets.ProductListViewAdmin',
        array(
            'id' => 'products-list',
            'htmlOptions' => array(
                'class' => $typeCatalog
            ),
            'typeCatalog' => $typeCatalog,
            'itemView' => '_product_one_for_list',
            'dataProvider' => $dataProducts,
            'ajaxUpdate' => false,
            'emptyText' => '',
            'template' => $header."{counter}\n{mainItems}\n<div class=\"row\"><div class=\"col-xs-12 text-center\">{pager}</div></div>",
            'pager' => array(
                'class' => 'bootstrap.widgets.BsPager',
                'firstPageLabel' => '<<',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
                'lastPageLabel' => '>>',
                'hideFirstAndLast'=>true,
            ),
            'counter' => $count,
        )
    );

    $this->renderPartial('_modal_windows');
?>

<form method="POST" class="copy" data-module="news">

</form>

<script>
    $(function()
    {
        $('#left_page').on('click', function()
        {
            if($(this).find('.fa-angle-left').length && <?php echo $pages->currentPage ;?> != 0)
            {
                location.href = $(".pagination.pagination-sm li").eq(0).find('a').attr('href');
            }
            if($(this).find('.fa-angle-right').length && <?php echo $pages->currentPage .' < '.$page_size;?>)
            {
                location.href = $(".pagination.pagination-sm li:last").find('a').attr('href');
            }
            return false;
        });

        $('#right_page').on('click', function()
        {
            if($(this).find('.fa-angle-right').length && <?php echo $pages->currentPage + 1 .' < '.$page_size ;?>)
            {
                location.href = $(".pagination.pagination-sm li:last").find('a').attr('href');
            }
            return false;
        });
    });
</script>