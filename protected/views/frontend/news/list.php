<div class="news-list">
    <h1><?php echo $this->pageTitle ;?></h1>
<?php
    $this->widget('bootstrap.widgets.BsListView',
        array(
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
            'ajaxUpdate' => false,
            'template' => '<div class="row">{items}<div class="clearfix"></div><div class="col-xs-6">{pager}</div></div>',
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
?>
</div>