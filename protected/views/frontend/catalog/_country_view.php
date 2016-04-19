<?php
	$image = $data->getOneFile('original');
	if(!$image)
	{
		$image = Yii::app()->params['noimage'];
	}

	$link = $data->getUrlForItem(1);
?>

<a href = "/<?php echo $link ;?>" class = "item-link">
	<div class = "item">
		<div class="border"></div>
		<div class = "col-xs-4 no-left img-cont">
			<img src = "/<?php echo $image ;?>" alt = "">
<?php
			$stars = 0;

			$hot = false;
			$popular = false;
			$tema_tours = array();

			$stars = $data->getStars();
			$sale = unserialize($data->sale_info);

			$parameters = CatalogProductsParams::model()->findAll('product_id = :id', array(':id' => $data->id));

			if($parameters)
			{
				$hot = false;
				$popular = false;
				foreach($parameters as $value)
				{
					switch($value->params_id)
					{
						case Yii::app()->params['vylet']:
							$vylet = $value->value['value'];
							break;
						case Yii::app()->params['kyrort']:
							$kyrort = $value->value['value'];
							break;
						case Yii::app()->params['sostav']:
							$sostav = $value->value['value'];
							break;
						case Yii::app()->params['pitanie']:
							$pitanie = $value->value['value'];
							break;
						case Yii::app()->params['transport']:
							$transport = $value->value['value'];
							break;
						case Yii::app()->params['dlitelnost']:
							$dlitelnost = $value->value['value'];
							break;
						case Yii::app()->params['tema_tours']:
							$tema_tours[] = $value->value['value'];
							break;
						case Yii::app()->params['hot']:
							$hot = true;
							break;
						case Yii::app()->params['popular']:
							$popular = true;
							break;
					}
				}
			}

			$sale_price = ($data->getSalePrice($data->price, $data->sale_info));
			$sale_price = round(str_replace(" ", "", $sale_price));

			echo $hot ? '<span class = "hot">Горяший тур</span>' : '';
			echo $popular ? '<span class = "popular">Популярное</span>' : '';

			echo $sale[0] ? '<span class = "sale">'.$sale[0].'%</span>' : '';
?>
			<h3><?php echo $data->title ;?></h3>

			<div class = "stars">
<?php
				for($i = 0; $i < 5; $i++)
				{
					if($i < $stars['value'])
					{
						echo '<img src = "/images/star_full.png" alt = "">';
					}
					else
					{
						echo '<img src = "/images/star.png" alt = "">';
					}
				}
?>
			</div>
		</div>
		<div class = "col-xs-8 no-right">
			<div class = "row">
				<div class = "col-xs-3">
					<span class = "vylet">Вылет из: <b><?php echo isset($vylet) ? $vylet : '' ;?></b></span>
					<span class = "kyrort">Курорт: <b><?php echo isset($kyrort) ? $kyrort : '' ;?></b></span>
					<span class = "people"><b><?php echo isset($sostav) ? $sostav : '' ;?></b></span>
				</div>
				<div class = "col-xs-3">
					<span class = "supper">Питание: <b><?php echo isset($pitanie) ? $pitanie : '' ;?></b></span>
					<span class = "avia">Транспорт: <b><?php echo isset($transport) ? $transport : '' ;?></b></span>
					<span class = "calendar"><b><?php echo isset($dlitelnost) ? $dlitelnost : '' ;?></b></span>
				</div>
				<div class = "col-xs-3 no-right price-cont">
					От <br>
<?php
					if(isset($sale_price) && $sale_price)
					{
						echo '<span class = "price">'.Yii::app()->format->formatNumber($sale_price).'</span> руб<br/>';
						echo '<span class = "old-price">'.Yii::app()->format->formatNumber($data->price).'</span> руб';
					}
					else
					{
						echo '<span class = "price">'.Yii::app()->format->formatNumber($data->price).'</span> руб';
					}
?>
				</div>
				<div class = "clearfix"></div>
				<div class = "bottom col-xs-12 no-right">
<?php
					if(isset($tema_tours))
					{
						foreach($tema_tours as $key => $value)
						{
							if ($key == 2)
							{
								echo '<br>';
							}
							echo '<span>'.$value.'</span>';
						}
					}
?>
					<a href = "/<?php echo $link ;?>" class = "forward">Подробнее</a>
				</div>
			</div>
		</div>
		<div class = "clearfix"></div>
	</div>
</a>