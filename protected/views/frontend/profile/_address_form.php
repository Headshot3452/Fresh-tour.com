<?php
/* @var $this AddressController */
/* @var $model Address */
/* @var $form CActiveForm */
?>
<div class="main-title">Добавление адреса доставки</div>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'address-index-form',
        'action'=>$this->action->id!='address',
        'htmlOptions'=>array(
            'class'=>"form-horizontal",
        ),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="form-group ">
        <div class="col-xs-3"></div>
        <div class="col-xs-5"> <span class="fa fa-exclamation-circle"></span> <span class="notice">Заполните все поля, отмеченные звёздочкой « * »</span></div>
        <div class="col-xs-4"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'city_id'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->dropDownList($model,'city_id',CHtml::listData(City::model()->active()->findAll(),'id','title'),array('class'=>"form-control",'prompt'=>'Выберите '.mb_strtolower($model->getAttributeLabel('city_id'),'UTF-8'))); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'city_id'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'street'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->textField($model,'street',array('class'=>"form-control")); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'street'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'house'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->textField($model,'house',array('class'=>"form-control")); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'house'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'apartment'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->textField($model,'apartment',array('class'=>"form-control")); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'apartment'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'user_name'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->textField($model,'user_name',array('class'=>"form-control")); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'user_name'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 label-block"> <?php echo $form->labelEx($model,'phone'); ?>     </div>
        <div class="col-xs-5"> <?php echo $form->textField($model,'phone',array('class'=>"form-control")); ?> </div>
        <div class="col-xs-4"> <?php echo $form->error($model,'phone'); ?></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3">    </div>
        <div class="col-xs-5">
            <?php echo BsHtml::submitButton(Yii::t('app','Save'),
                    array('color' => BsHtml::BUTTON_COLOR_PRIMARY)
                ); ?>
        </div>
        <div class="col-xs-4"> </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form --> 