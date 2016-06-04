<?php
	$images = $data->getOneFile('big');

	$stars = $data->getStars();

	$sostav = $data->getSostav();

	$dlitelnost = $data->getDlitelnost();
?>
<div class="col-xs-3 search_result_container">
	<div class="small-container">
		<img class="small" src = "/<?php echo $images ;?>" alt = "<?php echo $data['title'] ;?>">
		<div class="small-caption caption">
			<h2><?php echo $data['title'] ;?></h2>
			<div class="stars">
<?php
				for($j = 0; $j < 5; $j++)
			    {
			        if($j < $stars['value'])
			        {
			            echo '<img src = "/images/star_full.png" alt = "">';
			        }
			        elseif($j > 0)
			        {
			            echo '<img src = "/images/star.png" alt = "">';
			        }
			        else
			        {
				        break;
			        }
			    }
?>
			</div>
			<h3>От <span><?php echo Yii::app()->format->formatNumber($data['price']) ;?> руб.</span></h3>
			<div class="footer-container">
				<span><?php echo $sostav['value'] ;?></span>
				<span><?php echo $dlitelnost['value'] ;?></span>
				<a class="forward" href = "/<?php echo $data->getUrlForItem($this->getUrlById(Yii::app()->params['pages']['strany-i-oteli'])) ;?>">Перейти</a>
			</div>
		</div>
	</div>
</div>