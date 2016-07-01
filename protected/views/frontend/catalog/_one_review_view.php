<div class="item">
	<div class="date"><?php echo Yii::app()->dateFormatter->format('dd. MM. yyyy', $data->create_time) ;?></div>
	<div class="title"><?php echo $data->header ;?></div>
	<div class="text">
		<?php echo $data->text ;?>
	</div>
	<div class="autor"><?php echo $data->fullname ;?></div>
	<a href = "">Показать больше</a>
</div>

<script>
	$(function()
	{
		$(".item .text").each(function()
		{
			var autoHeight = $(this).closest('.item').find('.text').css({'max-height': 'none'}).height();
			$(this).closest('.item').find('.text').css({"max-height": 118});

			if(autoHeight <= 119)
			{
				$(this).siblings('a').hide();
			}
		});

		$('.item a').on('click', function(e)
		{
			if($(this).text() == 'Показать больше')
			{
				var autoHeight = $(this).closest('.item').find('.text').css({'max-height': 'none'}).height();
				$(this).closest('.item').find('.text').css({"max-height": 118});
				$(this).closest('.item').find('.text').animate({ "max-height": parseInt(autoHeight) }, parseInt(500));
				$(this).text('Скрыть');
			}
			else
			{
				$(this).closest('.item').find('.text').animate({ "max-height": 118 }, parseInt(500));
				$(this).text('Показать больше');
			}

			return false;
		});
	});
</script>