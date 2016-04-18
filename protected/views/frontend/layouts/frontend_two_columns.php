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

			if(in_array($this->page_id, Yii::app()->params['pages']['o-kompanii-array']))
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
			elseif(in_array($this->page_id, Yii::app()->params['pages']['info-array']))
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
			elseif(in_array($this->page_id, Yii::app()->params['pages']['tyrs-array']))
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
			elseif(in_array($this->page_id, Yii::app()->params['pages']['strany-and-hotel']))
			{
				$result = $news;
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