<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BsActiveForm */
?>

<h3 class="lk_title text-left">
    Смена пароля
</h3>
<div class="clearfix"></div>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id'=>'users-changePassword-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of BsActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
    )); ?>

    <div class="form-group">
        <div class="col-xs-3 text-right left">
            <?php echo $form->labelEx($model,'password', array('label'=>'Текущий пароль')); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'password', array('class'=>'form-control', 'placeholder'=>'', 'value'=>'')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 text-right left">
            <?php echo $form->labelEx($model,'new_password'); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'new_password', array('class'=>'form-control', 'placeholder'=>'', 'value'=>'')); ?>
            <?php echo $form->error($model,'new_password'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 text-right left">
            <?php echo $form->labelEx($model,'password_confirm'); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'password_confirm', array('class'=>'form-control', 'placeholder'=>'', 'value'=>'')); ?>
            <?php echo $form->error($model,'password_confirm'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row buttons">
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-1">
                <?php
                    echo BsHtml::submitButton(Yii::t('app','Save'), array('id'=>'reg_btn', 'class' => 'green_btn'));
                    echo CHtml::link('Отмена', '/profile/index');
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->