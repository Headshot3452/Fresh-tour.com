<div class="form top-filter">

    <?php $form=$this->beginWidget('BsActiveForm', array(
        'id'=>'orders-filter',
        'method' => 'get',
        'enableAjaxValidation'=>false,
        'action' => array('orders/index'),
    )); ?>

    <div class="row">
    <div class="col-xs-2">
        <div class="filter-title">
            Статус заказов:
        </div>
        <?php
           echo BsHtml::dropDownList('status',Yii::app()->request->getParam('status'),Orders::getStatus(),array('empty'=>'-'));
        ?>
    </div>

    <div class="col-xs-3">
        <div class="filter-title">
            Период:
        </div>
        <div class="period">
            <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'dd.mm.yy',
                    ),
                    'value'=>Yii::app()->request->getParam('date_from'),
                    'htmlOptions'=>array(
                        'class'=>'from form-control',
                        'name'=>'date_from'
                    ),
                ));
            ?>
            &nbsp;-&nbsp;
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                // additional javascript options for the date picker plugin
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'dd.mm.yy',
                ),
                'value'=>Yii::app()->request->getParam('date_to'),
                'htmlOptions'=>array(
                    'class'=>'to form-control',
                    'name'=>'date_to'
                ),
            ));
            ?>
        </div>
    </div>

    <div class="col-xs-2">
        <div class="filter-title">
            Сотрудники:
        </div>
        <?php
            echo BsHtml::dropDownList('worker',Yii::app()->request->getParam('worker'),$workers,array('empty'=>'-'));
        ?>
    </div>

    <div class="col-xs-1">
        <div class="filter-title">
            Ярлыки:
        </div>
    </div>

    <div class="col-xs-3">
        <div class="filter-title">
            Сортировать по:
        </div>
        <?php
            echo BsHtml::dropDownList('sort',Yii::app()->request->getParam('sort'),$sort_list,array('empty'=>'-'));
        ?>
    </div>

    <div class="col-xs-1">
        <?php
            echo BsHtml::submitButton('',array('icon'=>BsHtml::GLYPHICON_SEARCH,'style'=>'margin-top:20px'));
        ?>
    </div>
    </div>

    <?php $this->endWidget(); ?>

</div>