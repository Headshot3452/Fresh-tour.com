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
				<h3><?php echo $this->pageTitle ;?> <img class="flag-country" src = "/<?php echo $flag ;?>" alt = ""></h3>
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
<?php
						$hot = $hots->getData();
						if(isset($hot) && !empty($hot))
						{
							echo
							'<div id="recently">
								<h2>Горящие туры '.$tree->padej.' </h2>';
								foreach($hot as $value)
								{
									$sale_array = unserialize($value->sale_info);
									$link = $value->getUrlForItem(1);
									$stars = $value->getStars();

									$image = $value->getOneFile('medium');

									$sostav = $value->getSostav();

									$dlitelnost = $value->getDlitelnost();

									if(!is_file($image))
									{
										$image = $value->getOneFile('big');
									}

									$sale = $sale_array[0] ? '<span class = "sale">'.$sale_array[0].'%</span>' : '';

									echo
									'<div class="item img-cont hot_tours_item">
										<a href="/'.$link.'">
											<img src = "/'.$image.'" alt = "">
											<h3>'.$value->title.'</h3>

											<div class = "stars">';

												for($i = 0; $i < 5; $i++)
												{
													if($i < $stars['value'])
													{
														echo '<img src = "/images/star_full.png" alt = "">';
													}
													elseif($i > 0)
													{
														echo '<img src = "/images/star.png" alt = "">';
													}
													else
													{
														break;
													}
												}

									$ico = ($value->price)
											? '<i class=" icon '.$this->currency_usd->currencyName->icon.'"></i>'
											: '<i class=" icon '.$this->currency_eur->currencyName->icon.'"></i>';
									$price = ($value->price) ? $value->price * $this->currency_byn->course : $value->price_eur * $this->currency_byn->course * $this->currency_eur->course;
									$price_int = ($value->price) ? $value->price : $value->price_eur;

									echo
											'</div>
											<h5>От <span>'.number_format($price, 2, ".", " ").' руб.</span></h5>
											<span class = "int-price">'.Yii::app()->format->formatNumber($price_int).$ico.'</span>
											<span class = "hot">Горящий тур</span>
											'.$sale.'
											<div class="footer-container">
												<span>'.$sostav['value'].'</span>
												<span>'.$dlitelnost['value'].'</span>
											</div>
										</a>
									</div>';
								}
							echo
								'<a href = "/'. $this->getUrlById(Yii::app()->params['pages']['hot-tour']).'?country='.$tree->id .'" class="all_news all_news_hot">Все горщие туры '.$tree->padej.' </a>
							</div>';
						}
?>
						<div id="recently-tours">
							<h2>Полезные статьи</h2>
							<ul class="useful-articles">
								<li><a href = "">Необычные места в Индии</a></li>
								<li><a href = "">Что посмотреть в Инди</a></li>
								<li><a href = "">Необычное жилье </a></li>
								<li><a href = "">Когда лучше ехать в Индию</a></li>
							</ul>
						</div>
<!--						<div id="top-offers">-->
<!--							<h2>Лучшие предложения</h2>-->
<!--							<div class="item">-->
<!--								<img src = "/images/recently-img.png" alt = "">-->
<!--							</div>-->
<!--							<div class="item">-->
<!--								<img src = "/images/recently-img2.png" alt = "">-->
<!--							</div>-->
<!--						</div>-->
					</div>
					<div class="col-xs-9 no-right">
						<h2 class="descr descr-about"><?php echo $tree->info ;?></h2>
						<div class="text">
							<?php echo $tree->text ;?>
						</div>
						<h3 class="descr hotel_title descr-kart"><?php echo $tree->title ;?> на карте</h3>
						<div id="map_country">
							<?php echo $tree->map ;?>
						</div>
						<h2 class="descr descr-near">FRESH TOUR рекомендует</h2>
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
										for($i = 0; $i < count($country_list); $i++)
										{
											$el_arr = $country_list[$i]['title'];
											$new_arr[] = $el_arr;
										}
										asort($new_arr);
										$keys = array_keys($new_arr);
										for($key=0; $key<count($keys); $key++)
										{
											$result[] = $country_list[$keys[$key]];
										}
										$country_list = $result;

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
						<h3 id="one_country_title">Туры <?php echo $tree->padej ;?> <i><?php echo $dataProducts->getTotalItemCount() ;?></i> </h3>
						<div class="sort">
							Сортировка по: <a href = "" class="<?php echo $sort ;?>">Цене <span></span> </a>
						</div>
<?php
						$count = $dataProducts->getTotalItemCount();

						$selected = isset($_COOKIE['count_item']) ? $_COOKIE['count_item'] : '';

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

								$("body").on("click", "#count li a", function()
				                {
				                    val = $(this).find("span").text();
				                    $.cookie("count_item", parseInt(val), {expires: 60, path: "/"});
				                    window.location.reload();
				                });
							';
							$cs->registerPackage('boot-select')->registerPackage("cookie")->registerScript('sorter', $sorter);
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
				cont = $("#CountryForm_tema_tours");

				count = $("#CountryForm_tema_tours .checkbox").length * 35 - 120;

				if(cont.height() == 125)
				{
					$("#CountryForm_tema_tours").animate({"height": count}, 20 );
					$(this).text("Скрыть");
				}
				else
				{
					$("#CountryForm_tema_tours").css({"height": "125px"});
					$(this).text("Показать еще");
				}
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

//			$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " Руб - " + $( "#slider-range" ).slider( "values", 1 ) + " Руб " );
//
//			var new_amount = String($("#amount").val()).replace(/(\d)(?=(\d{3})+([^\d]|$))/g, "$1 ");
//			$("#amount").val(new_amount);
		});
	';

	$cs->registerPackage('jquery.ui')->registerScript("price_line", $price_line);
?>