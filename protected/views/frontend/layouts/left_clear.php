<?php
	$this->renderPartial('//layouts/_header',array());
	$this->renderFile(Yii::getPathOfAlias('application.views').'/_all_alerts.php',array());
?>

<div id = "title-container">
	<img src = "/images/title-img.png" alt = "Слайд">
	<div class = "breadcrumbs-container">
		<div class = "container">
			<div class = "row">
				<div class = "breadcrumbs">
<?php
					if(!empty($this->breadcrumbs))
					{
						echo '<div>';

						$this->widget('bootstrap.widgets.BsBreadcrumb',
							array(
								'links' => $this->breadcrumbs,
							)
						);

						echo '</div>';
					}
?>
				</div>
				<h1><?php echo $this->pageTitle; ?></h1>
			</div>
		</div>
		<div class = "clearfix"></div>
	</div>
</div>

<div id="main-content">
	<div class="container">
		<div class="row">
<?php
			$menu =
				'<ul class="left-title">
                    <h2>Туры и визы</h2>
                    [[w:MenuWidget|menu_id=27;menu_type=custom;]]
                </ul>';

			$result = $menu;

			echo
				'<div id="tyrs" class="vizy">
                    <div class="col-xs-3 no-left">
                        '.$result.'
                    </div>
                    <div class="col-xs-9 no-right">
	                    <div id="tyr-content">
							<div id="description">';

								$model = new BronForm();

								$form = $this->beginWidget('BsActiveForm',
									array(
										'id' => 'zakaz-tyr',
										'htmlOptions' => array(
											'role' => 'form',
											'class' => 'poland'
										),
										'enableAjaxValidation' => false,
										'enableClientValidation' => true,
										'clientOptions' => array(
											'validateOnSubmit' => true,
											'validateOnChange' => true,
											'validateOnType' => false,
										),
									)
								);
?>
								<div class = "form-group col-xs-6 no-left">
									<?php echo $form->labelEx($model, 'country', array('label' => Yii::t('app', 'Where you want to go'))); ?>
									<?php echo $form->dropDownList($model, 'country', CatalogTree::getCountry(), array('empty' => Yii::t('app', 'Choose the country'))); ?>
									<?php echo $form->error($model, 'country'); ?>
								</div>

								<div class = "form-group col-xs-6 no-right">
									<?php echo $form->labelEx($model, 'name'); ?>
									<?php echo $form->textField($model, 'name', array('placeholder' => 'Иванов Иван')); ?>
									<?php echo $form->error($model, 'name'); ?>
								</div>

								<div class = "form-group col-xs-6 no-left">
									<?php echo $form->labelEx($model, 'email'); ?>
									<?php echo $form->textField($model, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
									<?php echo $form->error($model, 'email'); ?>
								</div>

								<div class = "form-group col-xs-6">
<?php
									echo $form->labelEx($model, 'phone');

									$this->widget('CMaskedTextField',
										array(
											'model' => $model,
											'attribute' => 'phone',
											'mask' => Yii::app()->params['phone']['mask'],
											'htmlOptions' => array(
												'placeholder' => $model->getAttributeLabel('phone'),
												'class' => 'form-control',
											)
										)
									);
									echo $form->error($model, 'phone');
?>
								</div>

								<div class = "form-group">
									<?php echo $form->labelEx($model, 'questions'); ?>
									<?php echo $form->textarea($model, 'questions', array('placeholder' => 'Оставьте свое предложение..')); ?>
									<?php echo $form->error($model, 'questions'); ?>
								</div>
<?php
								echo BsHtml::submitButton(Yii::t('app', 'Book'), array('id' => 'viz_submit'));
								$this->endWidget();
?>
							</div>
						</div>
						<div class="text">
							<?php echo $this->text ;?>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<?php
	$this->renderPartial('//layouts/_footer',array());
?>