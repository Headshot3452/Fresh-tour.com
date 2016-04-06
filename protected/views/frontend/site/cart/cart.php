<div class="form">

    <?php
    $form=$this->beginWidget('CActiveForm', array(
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'stateful'=>true,
        'htmlOptions'=>array(
            'class'=>"form-horizontal center",
        ),
    ));

    ?>

    <?php
    echo $form->errorSummary($model,'');
    ?>

    <?php echo $model->cart; ?>

    <?php echo $form->hiddenField($model,'products'); ?>

    <div class="row buttons">
        <?php echo BsHtml::submitButton('Оформить заказ',
            array('name'=>'step','value'=>$model->step,'class'=>'btn btn-danger pull-right')
        ); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->