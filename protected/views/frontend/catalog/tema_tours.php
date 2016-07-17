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

<?php
	$tours = $dataProducts->getData();
	$count_tours = $dataProducts->getTotalItemCount();
?>

<div id="main-content">
	<div id="temat-tyrs" class="tema-page">
		<div class="container">
			<div class="row">
				<div class="col-xs-3 no-left">
					<ul class="nav nav-tabs">
<?php
						for($i = 0; $i < 5; $i++)
						{
							$image = $tours[$i]->getOneFile('medium');

							if(!is_file($image))
							{
								$image = $tours[$i]->getOneFile('big');
							}

							$active = ($i == 0) ? 'active' : '';
							echo
								'<li class="'.$active.'">
									<img src = "/'.$image.'">
									<a href="#'.$tours[$i]['name'].'" data-toggle="tab">'.$tours[$i]['title'].'</a>
									<span></span>
								</li>';

							$tabs[] = $tours[$i]['name'];
						}
?>
						<div class="clearfix"></div>

						<div id="recently-tours">
							<h2>Ещё тематические туры</h2>
<?php
							for($i = 5; $i < $count_tours; $i++)
							{
								$active = ($i == 0) ? 'active' : '';
								echo
								'<a data-toggle="tab" href = "#'.$tours[$i]['name'].'">'.$tours[$i]['title'].'</a>';

								$tabs[] = $tours[$i]['name'];
							}
?>
						</div>
					</ul>
				</div>
				<div class="col-xs-9 no-right">
					<div class="tab-content">
<?php
						if(isset($tours))
						{
							foreach($tours as $key => $value)
							{
								$tem_slider_array = CatalogProducts::model()->with('parameters_value')->active()->findAll(
									array(
										'condition' => 'parameters_value.value = :par',
										'params' => array('par' => $value['title']),
										'order' => 't.parent_id'
									)
								);

								$active = ($key == 0) ? 'active' : '';
								$num = 0;

								echo
									'<div role="tabpanel" class="tab-pane '.$active.'" id="'.$value['name'].'">
										<h1>'.$value['title'].'</h1>';

										if($tem_slider_array)
										{
											$tem_slider = '';

											foreach($tem_slider_array as $k => $v)
											{
												$stars = $v->getStars();
												$dlitelnost = $v->getDlitelnost();
												$sostav = $v->getSostav();

												$end = false;

												$image = $v->getOneFile('medium');

												if(!is_file($image))
												{
													$image = $v->getOneFile('big');
												}

												if(!isset($new_parent) || $new_parent != $v->parent_id)
												{
													$new_parent = $v->parent_id;
													$parent = CatalogTree::model()->active()->findByPk($v->parent_id);
													if($parent)
													{
														$img = $parent->getOneFile('small');

														if($num > 0 && $num < 4)
														{
															echo $tem_slider . '</div>';
															$tem_slider = '';
															$end = true;
														}

														echo
															'<div class="list-tour">
																<img src = "/' . $img . '">
																<span>' . $parent->title . '</span>
																<a href = "/' . $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) . '/' . $parent->name . '">Список туров</a>
															</div>';

														$num++;

														if($num < 4)
														{
															$tem_slider = '<div class="tem-slide-' . $num . '">';
															$end = false;
														}
													}
												}

												if($num < 4)
												{
													$tem_slider .=
															'<div>
																<img class="small" src = "/' . $image . '">
																<div class="small-caption caption">
																	<h2>' . $v->title . '</h2>
																	<div class="stars">';
																		for($i = 0; $i < 5; $i++)
																		{
																			if($i < $stars['value'])
																			{
																				$tem_slider .= '<img src = "/images/star_full.png">';
																			}
																			elseif($i > 0)
																			{
																				$tem_slider .= '<img src = "/images/star.png">';
																			}
																			else
																			{
																				break;
																			}
																		}

													$ico = ($v->price)
															? '<i class=" icon '.$this->currency_usd->currencyName->icon.'"></i>'
															: '<i class=" icon '.$this->currency_eur->currencyName->icon.'"></i>';
													$price = ($v->price) ? $v->price * $this->currency_byn->course : $v->price_eur * $this->currency_byn->course * $this->currency_eur->course;
													$price_int = ($v->price) ? $v->price : $v->price_eur;

													$tem_slider .=
																	'</div>
																	<h3>От <span>'.number_format($price, 2, ".", " ").' руб.</span></h3>
																	<span class = "int-price tem-price">'.Yii::app()->format->formatNumber($price_int).$ico.'</span>
																	<div class="footer-container">
																		<span>'.$sostav['value'].'</span>
																		<span>'.$dlitelnost['value'].'</span>
																		<a class="forward" href = "/' . $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) . '/' . $parent->name . '/' . $v->name . '">Перейти</a>
																	</div>
																</div>
															</div>';
												}

											}
											if(isset($end) && !$end)
											{
												if($num < 4)
												{
													echo $tem_slider.'</div>';
													$end = true;
												}
											}
										}
								echo
										'<div class="clearfix"></div>
										<div class="text">
											'.$this->text.'
										</div>
									</div>';
							}
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
	$slider_tem = '

		for(i = 1; i <= 10; i++)
		{
			el = ".tem-slide-"+i;

			$(el).slick(
			{
				slidesToShow: 3,
				slidesToScroll: 1,
				dots: true,
				infinite: true,
				speed: 500,
				arrows: false,
				autoplay: true,
				autoplaySpeed: 5000,
			});
		}

		var tab = window.location.hash;
		tab = tab.replace("#", "");

		if(tab)
		{
			var link = "a[href=#"+tab+"]";
			$("#temat-tyrs .nav-tabs").find(link).tab("show");
		}

    ';
	$cs->registerScript('slider_tem', $slider_tem,  CClientScript::POS_END);