<div id = "title-container" class="tyr-posad poland">
	<img src = "/images/title-img.png" alt = "Слайд">
	<div class = "breadcrumbs-container">
		<div class = "container">
			<div class = "row">
				<div class = "breadcrumbs">
<?php
					$images = $product->getFiles();
					$count = 0;

					foreach($images as $image)
					{
						if($count == 0)
						{
							$img = $image['path'].'original/'.$image['name'];
						}
						elseif($count == 1)
						{
							$flag = $image['path'].'original/'.$image['name'];
						}
						$count++;
					}

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

					foreach($product->parameters_value as $value)
					{
						if($value["params_id"] == 3)
						{
							$type = $value["value"];
						}
					}
?>
				</div>

				<a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['visy']) ;?>" class="back-to-country">Визы</a>

<?php
				echo isset($type) ?
					'<div id="bonus-cont">
						<span class="hot count">'.$type.'</span>
					</div>' : '';
?>
				<div class="price">
<?php
					preg_match_all("/([0-9]*)([0-9]{3})$/", $product->price, $price);

					$little_price = (isset($price[1][0]) && $price[1][0] < 1000) ? $price[1][0] : 0;
?>
					<span><?php (isset($price[1][0]) && $price[1][0] > 999) ? Yii::app()->format->formatNumber($price[1][0]) : $little_price ;?> </span> 000 руб
				</div>

				<h1><?php echo $product->title ;?><img class="flag-country" src = "/<?php echo isset($flag) ? $flag : '' ;?> " alt = ""></h1>

				<div id="country-info">
					<div class="col-xs-2 col-xs-offset-10 no-right">
						<a href = "">Заказать визу</a>
					</div>
				</div>
			</div>
		</div>
		<div class = "clearfix"></div>
	</div>
</div>

<div id = "main-content">
	<div class = "container">
		<div class = "row">
<?php
			$recently =
				'<div id="recently">
					<h2>Наш офис</h2>
					<div class="address">
						' . $this->settings['address'] . '
					</div>
					<div class="work">
						' . $this->settings['work'] . '
					</div>
					<div class="phone">
						' . $this->mts[1][0] . ' <span> ' . $this->mts[2][0] . '</span></span> <br>
						' . $this->velcom[1][0] . ' <span> ' . $this->velcom[2][0] . '</span></span>
					</div>
					<div class="mail">
						' . $this->settings['email_order'] . '
					</div>
				</div>';

			$menu =
				'<ul class="left-title">
                    <h2>Туры и визы</h2>
                    [[w:MenuWidget|menu_id=27;menu_type=custom;]]
                </ul>';

			$result = $menu;

			$result .= $recently;

			echo
				'<div id="tyrs" class="vizy">
	                <div class="col-xs-3 no-left">
	                    ' . $result . '
	                </div>
	                <div class="col-xs-9 no-right">
	                    <div id="tyr-content">
							<div id="description">
								<h2 class="descr descr-about">Информация о визе</h2>
								<div class="text">
									' . $product->text . '
								</div>';

								$model = new VizaForm();

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
								<div class = "form-group col-xs-4 no-left">
									<?php echo $form->labelEx($model, 'name'); ?>
									<?php echo $form->textField($model, 'name', array('placeholder' => 'Иванов Иван')); ?>
									<?php echo $form->error($model, 'name'); ?>
								</div>

								<div class = "form-group col-xs-4">
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

								<?php echo $form->hiddenField($model, 'country', array('value' => $product->title)) ;?>

								<div class = "form-group col-xs-4 no-right">
									<?php echo $form->labelEx($model, 'email'); ?>
									<?php echo $form->textField($model, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
									<?php echo $form->error($model, 'email'); ?>
								</div>

								<div class = "form-group col-xs-4 no-left">
<?php
									echo $form->labelEx($model, 'date_to');

									$this->widget('zii.widgets.jui.CJuiDatePicker',
										array(
											'language' => 'ru',
											'model' => $model,
											'attribute' => 'date_to',
											'options' => array(
												'showAnim' => 'fold',
											),
											'htmlOptions' => array(
												'class' => 'form-control',
												'value' => (!empty($model->date_to)) ? date("d.m.Y", $model->date_to) : '',
												'placeholder' => '01.01.2016'
											),
										)
									);

									echo $form->error($model, 'date_to');
?>
								</div>

								<div class = "form-group col-xs-4">
<?php
									echo $form->labelEx($model, 'date_from');

									$this->widget('zii.widgets.jui.CJuiDatePicker',
										array(
											'language' => 'ru',
											'model' => $model,
											'attribute' => 'date_from',
											'options' => array(
												'showAnim' => 'fold',
											),
											'htmlOptions' => array(
												'class' => 'form-control',
												'value' => (!empty($model->date_from)) ? date("d.m.Y", $model->date_from) : '',
												'placeholder' => '01.01.2016'
											),
										)
									);

									echo $form->error($model, 'date_from');
?>
								</div>

								<div class = "form-group col-xs-1">
									<?php echo $form->labelEx($model, 'child'); ?>
									<?php echo $form->dropDownList($model, 'child', array_combine(range(0, 12), range(0, 12))); ?>
									<?php echo $form->error($model, 'child'); ?>
								</div>

								<div class = "form-group col-xs-1 no-right">
									<?php echo $form->labelEx($model, 'man'); ?>
									<?php echo $form->dropDownList($model, 'man', array_combine(range(1, 12), range(1, 12))); ?>
									<?php echo $form->error($model, 'man'); ?>
								</div>

								<div class = "form-group">
									<?php echo $form->labelEx($model, 'questions'); ?>
									<?php echo $form->textarea($model, 'questions', array('placeholder' => 'Оставьте свое предложение..')); ?>
									<?php echo $form->error($model, 'questions'); ?>
								</div>
<?php
								echo BsHtml::submitButton(Yii::t('app', 'Order visa'), array('id' => 'viz_submit'));
								$this->endWidget();
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	$(function()
	{
		$("#country-info a").click(function()
		{
			var destination = $('#viz_submit').offset().top;
			$('body, html').animate( { scrollTop: destination - 500 }, 1100 );
			return false;
		});
	});

</script>
