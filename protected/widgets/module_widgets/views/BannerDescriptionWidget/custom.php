<?php
	$image = $this->_banner->getOneFile($this->size);
	if ($image == '')
	{
		$image = Yii::app()->params['noimage'];
	}
?>

<div id="banner">
	<h2>Рекламный баннер</h2>
		<a href = "<?php echo $this->_banner->url ;?>">
			<div>
				<img src = "/<?php echo $image ;?>" alt = "Рекламный баннер">
			</div>
		</a>
</div>
<div class="clearfix"></div>