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
	$count_tours = count($tours);
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
							$image = $tours[$i]->getOneFile('big');
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
								$image = $tours[$i]->getOneFile('big');
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
										<h1>'.$value['title'].'</h1>
										<div class="text">
											'.$this->text.'
										</div>';

										if($tem_slider_array)
										{
											$tem_slider = '';

											foreach($tem_slider_array as $k => $v)
											{
												$stars = $v->getStars();
												$end = false;

												$image = $v->getOneFile('big');

												if(!$image)
												{
													$image = Yii::app()->params['noimage'];
												}

												if(!isset($new_parent) || $new_parent != $v->parent_id)
												{
													$new_parent = $v->parent_id;
													$parent = CatalogTree::model()->active()->findByPk($v->parent_id);
													if($parent)
													{
														$img = $parent->getOneFile('small');

														if($num > 0)
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
														$tem_slider = '<div class="tem-slide-' . $num . '">';
														$end = false;
													}
												}

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
																	else
																	{
																		$tem_slider .= '<img src = "/images/star.png">';
																	}
																}
												$tem_slider .=
															'</div>
															<h3>От <span>' . Yii::app()->format->formatNumber($v->price) . ' руб.</span></h3>
															<div class="footer-container">
																<span>2 человека</span>
																<span>7 ночей с 7.09</span>
																<a class="forward" href = "/' . $this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']) . '/' . $parent->name . '/' . $v->name . '">Перейти</a>
															</div>
														</div>
													</div>';
											}
											if(isset($end) && !$end)
											{
												echo $tem_slider.'</div>';
												$end = true;
											}
										}
								echo
										'<div class="clearfix"></div>
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
		$(".tem-slide-1").slick(
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

		$(".tem-slide-2").slick(
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

		$(".tem-slide-3").slick(
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
    ';
	$cs->registerScript('slider_tem', $slider_tem,  CClientScript::POS_END);