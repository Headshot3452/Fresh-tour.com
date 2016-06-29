<div class="item">
	<div class="date"><?php echo Yii::app()->dateFormatter->format('dd. MM. yyyy', $data->create_time) ;?></div>
	<div class="title"><?php echo $data->header ;?></div>
	<div class="text">
		<?php echo $data->text ;?>
	</div>
	<div class="autor"><?php echo $data->fullname ;?></div>
<!--	<a href = "">Показать больше</a>-->
</div>