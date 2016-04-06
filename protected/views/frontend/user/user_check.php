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
    <div class="form-group text-center title">
        <?php // добавить описание в app.php?>
        Восстановление пароля
    </div>

	<div class="row control-group form-group">
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email',array('class'=>'errorMessage')); ?>
	</div>

    <?php
    if(CCaptcha::checkRequirements() && Yii::app()->user->issetCaptcha())
    {
        echo CHtml::activeLabelEx($model, 'captcha',array('class'=>'control-label'));
        $this->widget('CCaptcha');
        echo CHtml::activeTextField($model, 'captcha');
    }
    ?>

	<div class="row buttons control-group">
            <?php echo BsHtml::submitButton(Yii::t('app','Reset'),array('color'=>BsHtml::BUTTON_COLOR_PRIMARY)); ?>
            <?php echo BsHtml::link(Yii::t('app','Login'),$this->createUrl('login'), array('class'=>'back')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->