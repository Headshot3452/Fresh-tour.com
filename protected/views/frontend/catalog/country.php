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
						$this->breadcrumbs[] = $tree->title;
						$this->setPageTitle($tree->title);

						echo '<div>';

							$this->widget('bootstrap.widgets.BsBreadcrumb',
								array(
									'links' => $this->breadcrumbs,
								)
							);

						echo '</div>';
					}

				$images = $tree->getFiles();

				$image = next($images);

				$flag = $image['path'].'small/'.$image['name'];
?>
				</div>
				<a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) ;?>" class="back-to-country">К списку стран</a>
				<span id="time"><?php echo $tree->difference;?></span>
				<h1><?php echo $this->pageTitle ;?> <img class="flag-country" src = "/<?php echo $flag ;?>" alt = ""></h1>
				<div id="country-info">
					<div class="col-xs-3 no-left">
						Столица:
						<p><?php echo $tree->capital ;?></p>
					</div>
					<div class="col-xs-3">
						Язык:
						<p><?php echo $tree->language ;?></p>
					</div>
					<div class="col-xs-3">
						Денежная единица:
						<p><?php echo $tree->currency ;?></p>
					</div>
					<div class="col-xs-1">
						Виза:
						<p><?php echo ($tree->viza) ? 'Нужна' : 'Нет' ;?></p>
					</div>
<?php
					if ($tree->viza)
					{
						$t = $tree->viza_info ? 'Информация' : 'Заказать визу';
						echo
							'<div class="col-xs-2">
								<a href = "/'.$this->getUrlById(Yii::app()->params['pages']['visy']).'/'.$tree->viza .'">'.$t.'</a>
							</div>';
					}
?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div id="main-content">
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs country-tabs">
				<li><a href="#description" data-toggle="tab">Описание</a><span></span></li>
				<li class="active"><a href="#tyrs" data-toggle="tab">Туры</a><span></span></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane" id="description">
					<div class="col-xs-3 no-left">
						<div id="recently">
							<h2>Горящие туры в Индию</h2>
							<div class="item">
								<img src = "/images/recently-img.png" alt = "">
							</div>
							<div class="item">
								<img src = "/images/recently-img2.png" alt = "">
							</div>
							<a href = "" class="all_news">Все горщие туры в Индию</a>
						</div>
						<div id="recently-tours">
							<h2>Полезные статьи</h2>
							<ul class="useful-articles">
								<li><a href = "">Необычные места в Индии</a></li>
								<li><a href = "">Что посмотреть в Инди</a></li>
								<li><a href = "">Необычное жилье </a></li>
								<li><a href = "">Когда лучше ехать в Индию</a></li>
							</ul>
						</div>
						<div id="top-offers">
							<h2>Лучшие предложения</h2>
							<div class="item">
								<img src = "/images/recently-img.png" alt = "">
							</div>
							<div class="item">
								<img src = "/images/recently-img2.png" alt = "">
							</div>
						</div>
					</div>
					<div class="col-xs-9 no-right">
						<h2 class="descr descr-about">О стране</h2>
						<div class="text">
							<?php echo $tree->text ;?>
						</div>
						<h2 class="descr descr-kart"><?php echo $tree->title ;?> на карте</h2>
						<div id="map_country">
							<?php echo $tree->map ;?>
						</div>
						<h2 class="descr descr-near">Страны рядом</h2>
						<div class="kyrorts">
							<div class="row">
<?php
								if($tree->country_near)
								{
									$country_list = array();
									$_list = unserialize($tree->country_near);
									if(is_array($_list))
									{
										$_country_list = implode(',', array_values($_list));
										$country_list = CatalogTree::model()->active()->findAll('id IN ('.$_country_list.')');
									}

									if($country_list)
									{
										foreach($country_list as $value)
										{
											echo
												'<div class="col-xs-2">
													<a href = "/'.$this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']).'/'.$value->name.'">'.$value->title.'</a>
												</div>';
										}
									}
								}
?>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane active" id="tyrs">
					<div class="col-xs-3 no-left">
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
							<label class="search">Быстрый поиск <a href = "/<?php echo $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']).'/'.$tree->name ;?>">Очистить</a></label>
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
?>
						</div>
					</div>
					<div class="col-xs-9 no-right">
						<h1>Туры <?php echo $tree->padej ;?> <i><?php echo $dataProducts->getItemCount() ;?></i> </h1>
						<div class="sort">
							Сортировка по: <a href = "" class="<?php echo $sort ;?>">Цене <span></span> </a>
						</div>
<?php
						$count = $dataProducts->getItemCount();

						$counter = '
							<div id="count">
	                            Показывать по <a href = "" >6</a> строк
				            </div>';

						if ($count > 0)
						{
							$cs = Yii::app()->getClientScript();
							$sorter = '
								$("body").on("click", ".sort a", function()
								{
									if($(this).hasClass("price_asc"))
									{
										$.cookie("sort_products", "price_desc", {expires: 3600, path: "/"});
									}
									else if($(this).hasClass("price_desc"))
									{
										$.cookie("sort_products", "price_asc", {expires: 3600, path: "/"});
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
								'<div class="text">
									'.$tree->preview.'
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

			$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " Руб - " + $( "#slider-range" ).slider( "values", 1 ) + " Руб " );

			var new_amount = String($("#amount").val()).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ");
			$("#amount").val(new_amount);
		});
	';

	$cs->registerPackage('jquery.ui')->registerScript("price_line", $price_line);
?>