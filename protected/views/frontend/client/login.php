<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form BsActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'users-login-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
    <h1 class="lk_title text-left col-xs-4 col-xs-offset-4">
        <?php
            echo Yii::t('app','Your Personal Area');
        ?>
    </h1>

    <div class="clearfix"></div>

	<div class="form-group">
        <div class="col-xs-4 text-right">
            <?php echo $form->labelEx($model,'email'); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($model,'email',array('class'=>'errorMessage', 'placeholder'=>'')); ?>
        </div>
        <div class="clearfix"></div>
	</div>

    <div class="form-group">
        <div class="col-xs-4 text-right">
            <?php echo $form->labelEx($model,'password',array('label'=>Yii::t('app', 'Password'))); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($model,'password',array('class'=>'errorMessage', 'placeholder'=>'Пароль')); ?>
        </div>
        <div class="clearfix"></div>
    </div>

	<div class="buttons form-group">
        <div class="col-xs-4 text-right"></div>
        <div class="col-xs-4">
<?php
            echo BsHtml::submitButton(Yii::t('app','Login'), array('color' => BsHtml::BUTTON_COLOR_PRIMARY));

            if (Yii::app()->params['site']['allow_register'])
            {
                echo BsHtml::link(Yii::t('app','Register'),array('user/register'), array('class'=>'blue_link', 'id'=>'registry_link'));
            }

            echo BsHtml::link(Yii::t('app','Forgot your password?'), $this->createUrl('client/passwordreset'), array('class'=>'blue_link', 'id'=>'forget_password') ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->