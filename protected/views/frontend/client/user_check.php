<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BsActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'users-login-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'center'),
)); ?>
    <h1 class="lk_title text-left col-xs-4 col-xs-offset-4">
        <?php
            echo Yii::t('app','Password recovery');
        ?>
    </h1>

    <div class="require col-xs-4 col-xs-offset-4">
        <span class="fa fa-exclamation-circle"></span>
        <span class="notice">Заполните все поля, отмеченные звёздочкой « * »</span>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
        <div class="col-xs-4 text-right">
            <?php echo $form->labelEx($model,'email',array('label'=>Yii::t('app', 'Your e-mail'))); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($model,'email',array('class'=>'errorMessage', 'placeholder'=>'')); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="buttons form-group">
        <div class="col-xs-4 text-right"></div>
        <div class="col-xs-4">
            <?php echo BsHtml::submitButton(Yii::t('app','Reset'),array('id'=>'reset', 'color'=>BsHtml::BUTTON_COLOR_PRIMARY)); ?>
            <?php echo BsHtml::link(Yii::t('app','Cancel'),$this->createUrl('/userlogin'), array('class'=>'back')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->