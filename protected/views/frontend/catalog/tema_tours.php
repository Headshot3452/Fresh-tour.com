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
								$active = ($key == 0) ? 'active' : '';

								echo
									'<div role="tabpanel" class="tab-pane '.$active.'" id="'.$value['name'].'">
										<h1>'.$value['title'].'</h1>
										<div class="text">
											'.$this->text.'
										</div>';

								$tem_slider = CatalogProducts::model()->with('parameters_value')->active()->findAll(
									array(
										'condition' => 'parameters_value.value = :par',
										'params' => array('par' => $value['title']),
										'order' => 't.parent_id'
									)
								);

								if($tem_slider)
								{
									foreach($tem_slider as $k => $v)
									{
										if(!isset($new_parent) || $new_parent != $v->parent_id)
										{
											$new_parent = $v->parent_id;
											$parent = CatalogTree::model()->active()->findByPk($v->parent_id);
											if($parent)
											{
												$img = $parent->getOneFile('small');
												echo
													'<div class="list-tour">
														<img src = "/'.$img.'">
														<span>'.$parent->title.'</span>
														<a href = "/'.$this->getUrlById(Yii::app()->params['pages']['strany-i-oteli']).'/'.$parent->name.'">Список туров</a>
													</div>';
											}
										}
									}
								}
								echo '</div>';
							}
						}
?>
					</div>

<!--					<div class="list-tour">-->
<!--						<img src = "/images/fresh2.png" alt = "">-->
<!--						<span>ОАЭ</span>-->
<!--						<a href = "">Список туров</a>-->
<!--					</div>-->
<!---->
<!--					<div id="tem-slide-1">-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP-->
<!--								    STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="list-tour">-->
<!--						<img src = "/images/fresh2.png" alt = "">-->
<!--						<span>Индия</span>-->
<!--						<a href = "">Список туров</a>-->
<!--					</div>-->
<!---->
<!--					<div id="tem-slide-2">-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP-->
<!--								    STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="list-tour">-->
<!--						<img src = "/images/fresh2.png" alt = "">-->
<!--						<span>Турция</span>-->
<!--						<a href = "">Список туров</a>-->
<!--					</div>-->
<!---->
<!--					<div id="tem-slide-3">-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP-->
<!--								    STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div>-->
<!--							<img class="small" src = "/images/hotel1.png" alt = "">-->
<!--							<div class="small-caption caption">-->
<!--								<h2>STEUNG SIEM REAP</h2>-->
<!--								<div class="stars">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star_full.png" alt = "">-->
<!--									<img src = "/images/star.png" alt = "">-->
<!--								</div>-->
<!--								<h3>От <span>10 400 000 руб.</span></h3>-->
<!--								<div class="footer-container">-->
<!--									<span>2 человека</span>-->
<!--									<span>7 ночей с 7.09</span>-->
<!--									<a class="forward" href = "">Перейти</a>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!---->
<!--					<div class="row">-->
<!--						<div class="list-tour col-xs-4">-->
<!--							<img src = "/images/fresh2.png" alt = "">-->
<!--							<span>Австралия</span>-->
<!--							<a href = "">Список туров</a>-->
<!--						</div>-->
<!---->
<!--						<div class="list-tour col-xs-4">-->
<!--							<img src = "/images/fresh2.png" alt = "">-->
<!--							<span>Польша</span>-->
<!--							<a href = "">Список туров</a>-->
<!--						</div>-->
<!---->
<!--						<div class="list-tour col-xs-4">-->
<!--							<img src = "/images/fresh2.png" alt = "">-->
<!--							<span>Франция</span>-->
<!--							<a href = "">Список туров</a>-->
<!--						</div>-->
<!---->
<!--						<div class="list-tour col-xs-4">-->
<!--							<img src = "/images/fresh2.png" alt = "">-->
<!--							<span>Франция</span>-->
<!--							<a href = "">Список туров</a>-->
<!--						</div>-->
<!--					</div>-->

				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$cs = Yii::app()->getClientScript();
	$sorter = '

    ';
	$cs->registerPackage("cookie")->registerScript('sorter', $sorter);