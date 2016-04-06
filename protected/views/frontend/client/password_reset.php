<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BsActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'users-login-form',
	'enableAjaxValidation'=>false,
)); ?>

    <h1 class="lk_title text-left col-xs-4 col-xs-offset-4">
        Восстановление пароля
    </h1>

    <div class="require col-xs-4 col-xs-offset-4">
        <span class="fa fa-exclamation-circle"></span>
        <span class="notice">Введите новый пароль</span>
    </div>

    <div class="clearfix"></div>

    <div class="form-group">
        <div class="col-xs-4 text-right">
            <?php echo $form->labelEx($model,'password'); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'password', array('value'=>'', 'class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-4 text-right">
            <?php echo $form->labelEx($model,'password_confirm'); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'password_confirm', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($model,'password_confirm'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row buttons">
        <div class="form-group">
            <div class="col-xs-4 col-xs-offset-4">
<?php
                echo BsHtml::submitButton(Yii::t('app','Save'),array('class'=>'green_btn'));
                echo CHtml::link('Отмена', '/');
?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->