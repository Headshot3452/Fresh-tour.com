<div id="title-container">
	<img src = "/images/title-img.png" alt = "">
	<div class="breadcrumbs-container">
		<div class="container">
			<div class="row">
				<div class="breadcrumbs">
<?php
					if (!isset($url))
					{
						$url = '';
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
?>
				</div>
				<h3><?php echo $this->pageTitle ;?></h3>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div id="main-content">
	<div class="container">
		<div class="row">
			<div id="tyrs">
				<div class="col-xs-3 no-left">
					<ul class="left-title">
						<h2>Срочно!Горит!</h2>
						[[w:MenuWidget|menu_id=33;menu_type=custom;]]
					</ul>
<?php
					$form = $this->beginWidget('BsActiveForm',
						array(
							'id' => 'tours-active-form',
							'htmlOptions' => array(
								'role' => 'form',
							),
							'method' => 'get',
							'action' => $this->createUrl(Yii::app()->request->pathInfo),
							'enableAjaxValidation' => false,
							'enableClientValidation' => true,
						)
					);

					$model_products = new CountryForm();

					if(isset($_GET['CountryForm']))
					{
						$model_products->attributes = $_GET['CountryForm'];
					}
?>
					<div id="tours-form">
						<label class="search">Быстрый поиск <a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['hot-tour']) ;?>">Очистить</a></label>
						<hr>
						<div class="form-group">
<?php
							echo $form->labelEx($model_products, 'date_from');

							$this->widget('zii.widgets.jui.CJuiDatePicker',
								array(
									'language' => 'ru',
									'model' => $model_products,
									'attribute' => 'date_from',
									'options' => array(
										'showAnim' => 'fold',
									),
									'htmlOptions' => array(
										'class' => 'form-control',
										'placeholder' => 'Дата вылета'
									),
								)
							);

							echo $form->error($model_products, 'date_from');
?>
						</div>
						<hr>
<?php
						echo $form->labelEx($model_products, 'tema_tours');
?>
						<div class="form-group checkboxes">
<?php
							echo $form->checkBoxList($model_products, 'tema_tours',
								$model_products->getTemaTours(),
								array(
									'template' => '<div class="checkbox">{input}{label}<span></span></div>'
								)
							);
?>
						</div>
						<a href = "" class="all_news">Показать еще</a>
						<hr>
						<p>
							<?php echo $form->labelEx($model_products, 'price_tours') ;?>
						</p>
						<div id="slider-range"></div>
						<?php echo $form->textField($model_products, 'price_tours', array('id' => 'amount', 'readonly' => 'true', 'style' => 'border:0;')) ;?>
						<hr>
						<?php echo $form->labelEx($model_products, 'stars') ;?>
						<div class="form-group checkboxes checkboxes_stars">
<?php
							echo $form->checkBoxList($model_products, 'stars',
								array(
									'5' => '<img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" />',
									'4' => '<img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" />',
									'3' => '<img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" />',
									'2' => '<img src="/images/stars_gray.png" /><img src="/images/stars_gray.png" />',
									'1' => '<img src="/images/stars_gray.png" />',
								),
								array(
									'template' => '<div class="checkbox">{input}{label}<span></span></div>'
								)
							);
?>
						</div>
						<hr>
						<?php echo $form->labelEx($model_products, 'type_hotel') ;?>
						<div class="form-group checkboxes checkboxes_stars">
<?php
							echo $form->checkBoxList($model_products, 'type_hotel',
								$model_products->getTypeHotel(),
								array(
									'template' => '<div class="checkbox">{input}{label}<span></span></div>'
								)
							);
?>
						</div>
						<hr>
<?php
						if(isset($_GET['CountryForm']))
						{
							$all_count = $dataProducts->getTotalItemCount();
							echo '<div class="find">Найдено <i>'.$all_count.'</i> '. Yii::t('app', 'Tours', array($all_count)).'</div>';
						}

						echo BsHtml::submitButton(Yii::t('app', 'Show'));
						$this->endWidget();

						$selected = (isset($_GET['country']) && $_GET['country']) ? CHtml::encode($_GET['country']) : '';
						$one_country = new CatalogTree();
?>
					</div>
				</div>
					<div class="col-xs-9 no-right hot_tours_container">
						<h3 id="one_country_title">
							<?php echo $this->pageTitle ;?> <?php echo CHtml::dropDownList('one_country', $one_country, CatalogTree::getCountry(), array('class' => 'selectpicker', 'data-size' => '6', 'empty' => 'Все страны', 'options' => array($selected => array('selected' => true)))) ;?>
						</h3>

						<div class="sort">
							Сортировка по: <a href = "" class="<?php echo $sort ;?>">Цене <span></span> </a>
						</div>
<?php
						$count = $dataProducts->getItemCount();

						$counter = '
							<div id="count">
								Показывать по '. CHtml::dropDownList('count_item', '', array('6' => '6', '15' => '15' , '30' => '30'), array('class' => 'selectpicker', 'data-size' => '3', 'options' => array($selected => array('selected' => true)))) .' строк
				            </div>';

						if ($count > 0)
						{
							$cs = Yii::app()->getClientScript();
							$sorter = '
								$("body").on("click", ".sort a", function()
								{
									if($(this).hasClass("price_asc"))
									{
										$.cookie("sort_products", "price_desc", {expires: 60, path: "/"});
									}
									else if($(this).hasClass("price_desc"))
									{
										$.cookie("sort_products", "price_asc", {expires: 60, path: "/"});
									}
									else
									{
										$.cookie("sort_products", "price_desc", {expires: 60, path: "/"});
									}
									window.location.reload();
								});
							';
							$cs->registerPackage("cookie")->registerScript('sorter', $sorter);
						}
?>
						<div class="row">
<?php
							$this->widget('application.widgets.ProductListView',
								array(
									'id' => 'products-list',
									'itemView' => '_country_view',
									'dataProvider' => $dataProducts,
									'ajaxUpdate' => false,
									'template' => "{items}\n<div class=\"col-xs-12 text-center\">{pager}$counter</div>",
									'viewData' => array(
										'url' => $url,
										'count' => $count
									),
									'pager' => array(
										'class' => 'bootstrap.widgets.BsPager',
										'firstPageLabel' => '',
										'prevPageLabel' => '',
										'nextPageLabel' => '',
										'lastPageLabel' => '',
										'hideFirstAndLast' => true,
									)
								)
							);
?>
						</div>
						<div class="clearfix"></div>
<?php
						if(!isset($_GET['page']))
						{
							echo
							'<div class="text col-xs-12">
								'.$this->text.'
							</div>';
						}
?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$cs = Yii::app()->getClientScript();

	$price_line = '
			$(function()
			{
				$("#tours-form .search a").on("click", function()
				{
					$("#tours-active-form").reset();
					return false;
				});

				$(".hot_tours_container #one_country").on("change", function()
				{
					if($(this).val())
					{
						document.location.href = window.location.pathname+"?country="+$(this).val();
					}
					else
					{
						document.location.href = window.location.pathname;
					}
				});

				$("#tours-form .all_news").on("click", function()
				{
					$("#CountryForm_tema_tours").css({"height": "auto"});
					$(this).hide();
					return false;
				});

				$( "#slider-range" ).slider(
				{
					range: true,
					min: 0,
					max: 90000000,
					step: 1000,
					values: [ 0, 90000000 ],
					slide: function( event, ui )
					{
						ui.values[0] = String(ui.values[0]).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ");
						ui.values[1] = String(ui.values[1]).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ");

						$( "#amount" ).val( ui.values[0] + " Руб - " + ui.values[1] + " Руб ");
					}
				});

//				$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " Руб - " + $( "#slider-range" ).slider( "values", 1 ) + " Руб " );
//
//				var new_amount = String($("#amount").val()).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ");
//				$("#amount").val(new_amount);
			});
		';
	$cs->registerPackage('jquery.ui')->registerPackage('boot-select')->registerScript("price_line", $price_line);