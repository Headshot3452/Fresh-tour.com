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
		<div class="row" id="left_panel">
<?php
			$recently =
				'<div id="recently">
					<h2>Наш офис</h2>
					<div class="address">
						'.$this->settings['address'].'
					</div>
					<div class="work">
						'.$this->settings['work'].'
					</div>
					<div class="phone">
						'.$this->mts[1][0].' <span> '.$this->mts[2][0].'</span></span> <br>
						'.$this->velcom[1][0].' <span> '.$this->velcom[2][0].'</span></span>
					</div>
					<div class="mail">
						'.$this->settings['email_order'].'
					</div>
				</div>';

			$news = '[[w:NewsLastWidget|parent_id=2;count=3;]]';

			$child = Structure::model()->active()->findByPk($this->page_id);
			$parent = array();

			if($child)
			{
				$parent = $child->ancestors()->active()->find('level = 2');
			}

			$parent_id = isset($parent->id) ? $parent->id : 0;

			if(in_array(Yii::app()->params['pages']['o-kompanii'], array($this->page_id, $parent_id)) || $this->page_id == Yii::app()->params['pages']['agentstvam'])
			{
				$menu =
					'<ul class="left-title">
	                    <h2>О компании</h2>
	                    [[w:MenuWidget|menu_id=19;menu_type=custom;]]
	                </ul>';

				$result = $menu;

				if($this->page_id == Yii::app()->params['pages']['agentstvam'])
				{
					$result = $recently;
				}
			}
			elseif(in_array(Yii::app()->params['pages']['informaciya'], array($this->page_id, $parent_id)))
			{
				$result =
					'<ul class="left-title">
	                    <h2>Информация</h2>
	                    [[w:MenuWidget|menu_id=24;menu_type=custom;]]
	                </ul>

					[[w:BannerDescriptionWidget|banner_id=1;view=custom;]]
					[[w:BannerDescriptionWidget|banner_id=2;view=custom;]]
					[[w:BannerDescriptionWidget|banner_id=3;view=custom;]]
					[[w:BannerDescriptionWidget|banner_id=4;view=custom;]]
					[[w:BannerDescriptionWidget|banner_id=5;view=custom;]]';
			}
			elseif(in_array(Yii::app()->params['pages']['visy'], array($this->page_id, $parent_id)) || $parent_id == Yii::app()->params['pages']['tours_and_vizy'])
			{
				$menu =
					'<ul class="left-title">
	                    <h2>Информация</h2>
	                    [[w:MenuWidget|menu_id=27;menu_type=custom;]]
	                </ul>';

				$result = $menu;

				if($this->page_id == Yii::app()->params['pages']['visy'])
				{
					$result .= '[[w:BannerDescriptionWidget|banner_id=1;view=custom;]]';
				}
				elseif($this->page_id == Yii::app()->params['pages']['visa'])
				{
					$result .= $recently;
				}
			}
			elseif(in_array(Yii::app()->params['pages']['strany-i-oteli'], array($this->page_id, $parent_id)))
			{
				$session = Yii::app()->session;
				$session->open();

				$viewed = '';
				$tema_tours = '';

				if($session['viewed'])
				{
					ob_start();
					echo
					'<div id="recently">
						<h2>Недавно просмотренные</h2>';

					foreach($session['viewed'] as $val)
					{
						$value = CatalogProducts::model()->active()->findByPk($val);

						$sale_array = unserialize($value->sale_info);
						$link = $value->getUrlForItem(1);
						$stars = $value->getStars();

						$image = $value->getOneFile('original');

						$sostav = $value->getSostav();

						$dlitelnost = $value->getDlitelnost();

						$hot = $value->getIsHot() ? '<span class = "hot">Горящий тур</span>' : '';
						$popular = '';

						if(!$hot)
						{
							$popular = $value->getIsPopular() ? '<span class = "popular">Популярное</span>' : '';
						}

						if(!$image)
						{
							$image = Yii::app()->params['noimage'];
						}

						$sale = $sale_array[0] ? '<span class = "sale">' . $sale_array[0] . '%</span>' : '';

						echo
								'<div class="item img-cont hot_tours_item">
								<a href="/' . $link . '">
									<img src = "/' . $image . '" alt = "">
									<h3>' . $value->title . '</h3>

									<div class = "stars">';

						for($i = 0; $i < 5; $i++)
						{
							if($i < $stars['value'])
							{
								echo '<img src = "/images/star_full.png" alt = "">';
							} else
							{
								echo '<img src = "/images/star.png" alt = "">';
							}
						}

						$ico = ($value->price)
								? '<i class=" icon '.$this->currency_usd->currencyName->icon.'"></i>'
								: '<i class=" icon '.$this->currency_eur->currencyName->icon.'"></i>';
						$price = ($value->price) ? $value->price * $this->currency_byn->course : $value->price_eur * $this->currency_byn->course * $this->currency_eur->course;
						$price_int = ($value->price) ? $value->price : $value->price_eur;

						echo
								'</div>
									<h5>От <span>' . number_format($price, 2, ".", " ") . ' руб.</span></h5>
									<span class = "int-price">'.Yii::app()->format->formatNumber($price_int).$ico.'</span>
									' . $hot . $popular . '
									' . $sale . '
									<div class="footer-container">
										<span>' . $sostav['value'] . '</span>
										<span>' . $dlitelnost['value'] . '</span>
									</div>
								</a>
							</div>';
					}
					echo
					'</div>';

					$viewed = ob_get_clean();
				}

				$tema_categories = CatalogProducts::model()->active()->findAllByAttributes(array('parent_id' => Yii::app()->params['tema_catalog']));

				if($tema_categories)
				{
					ob_start();

					echo
					'<div id="recently-tours">
						<h2>Тематические туры</h2>';

						foreach($tema_categories as $key => $value)
						{
							if($key > 5)
							{
								break;
							}
							echo '<a href = "/'.$this->getUrlById(Yii::app()->params['pages']['tema-tours']).'/#'.$value->name.'">' . $value->title . '</a>';
						}
					echo
					'</div>
					<div class="clearfix"></div>';

					$tema_tours = ob_get_clean();
				}

				$result = $viewed . $tema_tours . $news;
			}

			echo
			'<div id="tyrs" class="vizy">
                <div class="col-xs-3 no-left">
                    '.$result.'
                </div>
                <div class="col-xs-9 no-right">
                    '.$content.'
                </div>
            </div>';
?>
		</div>
	</div>
</div>

<?php
	$this->renderPartial('//layouts/_footer',array());
?>