<?php
	$cs = Yii::app()->getClientScript();
	$slider_main = '
		$("#slider-main").slick(
		{
			dots: true,
			infinite: true,
			speed: 500,
			fade: true,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 5000,
		});
	';

	$cs->registerScript('slider_main', $slider_main, CClientScript::POS_READY);

	if(isset($this->_items))
	{
		foreach($this->_items as $item)
		{
			$image = $item->getOneFile('big');

			$description = $item['description'] ? '<h4>'.$item['description'].'</h4>' : '';
			$url = $item['url'] ? '<a class="more" href = "'.$item['url'].'">Подробнее</a>' : '';

			echo
				'<div class = "item">
				    <img src = "'.$image.'" alt = "Слайдер">
				    <div class = "carousel-caption">
				        <div class="col-xs-5 col-xs-offset-7 no-right text">
				            <h3>'.$item['title'].'</h3>
				            '.$description.'
				            '.$url.'
				        </div>
				    </div>
				</div>';
		}
	}