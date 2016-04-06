<?php
$cs = Yii::app()->getClientScript();

$cs->registerScript('orderslist', '
$(function () {
    $(\'[data-toggle="tooltip"]\').tooltip()
})
');

?>
<div class="row" style="margin: 10px 0 35px;">
    <div class="col-md-2 main-title-page" style="padding: 0;">Список заказов</div>
    <div class="col-md-1" style="line-height: 20px;"><a href="<?php echo $this->createUrl('archive'); ?>">Архив</a></div>
    <div class="col-md-3 col-md-offset-5"></div>
</div>
<div class="order-list">
    <div class="row header">
        <div class="c-num">№ заказа</div>
        <div class="c-date text-center">Дата</div>
        <div class="c-client">Клиент</div>
        <div class="c-sum">Товар / сумма</div>
        <div class="c-worker">Менеджер / Комплектовщик / Исполнитель</div>
        <div class="c-status">Статус</div>
    </div>
    <?php
    $this->widget('bootstrap.widgets.BsListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_item',
        'template'=>'{items}<div class="row"><div class="col-xs-12 text-center">{pager}</div></div>',
        'pager'=>array(
            'class'=>'bootstrap.widgets.BsPager',
            'nextPageLabel'=>'&raquo;',
            'prevPageLabel'=>'&laquo;',
            'hideFirstAndLast'=>true,
        ),
    ));
    ?>
</div>