<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form BsActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('BsActiveForm', array(
	'id'=>'slider-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of BsActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <div class="form-group buttons">
        <?php echo BsHtml::submitButton(Yii::t('app','Save'),array('color'=>BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        <span>Отмена</span>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->