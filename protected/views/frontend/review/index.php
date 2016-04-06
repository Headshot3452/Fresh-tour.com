<?php
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(
    Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.css') . '/backend_manenok.css')
);
?>
<div class="container">
    <h2 class='col-xs-12'>
        Модуль Отзывы
        <?php
        echo BsHtml::link('+ Добавить отзыв','add', array('class' => 'btn btn-primary col-xs-offset-1'));
        ?>
    </h2>
</div>


<div class="frontend_review_list">
    <div class="container">
        <?php

        $typeCatalog = 'small';
        $item_count = $model->getTotalItemCount();
        $pages = new CPagination($item_count);
        $page_size = $count;
        $pages->setPageSize($page_size);
        $page_count = ceil($item_count / $page_size);

        $this->widget('application.widgets.ProductListViewAdmin', array(
                'id' => 'products-list',
                'htmlOptions' => array(
                    'class' => $typeCatalog . ' reviews-list'
                ),
                'typeCatalog' => $typeCatalog,
                'itemView' => '_one_review',
                'dataProvider' => $model,
                'ajaxUpdate' => false,
                'template' => "<div class='row'><ul class='list-unstyled'>{mainItems}</ul></div><div class='col-xs-12 no-padding'>{pager}</div>",
                'pager' => array(
                    'class' => 'bootstrap.widgets.BsPager',
                    'firstPageLabel' => '1',
                    'prevPageLabel' => '<',
                    'nextPageLabel' => '>',
                    'lastPageLabel' => $page_count,
//                'hideFirstAndLast'=>true,
                ),
                'counter' => $count,
            )
        ); ?>
    </div>
</div>
</div>
<script>
    $(function () {
        $('#left_page').on('click', function () {
            if ($(this).find('.fa-angle-left').length && <?php echo $pages->currentPage ;?> != 0) {
                location.href = $(".pagination.pagination-sm li").eq(0).find('a').attr('href');
            }
            if ($(this).find('.fa-angle-right').length && <?php echo $pages->currentPage .' < '.$page_size;?>) {
                location.href = $(".pagination.pagination-sm li:last").find('a').attr('href');
            }
            return false;
        });

        $('#right_page').on('click', function () {
            if ($(this).find('.fa-angle-right').length && <?php echo $pages->currentPage + 1 .' < '.$page_size ;?>) {
                location.href = $(".pagination.pagination-sm li:last").find('a').attr('href');
            }
            return false;
        });
    });
</script>