<div id="recently-news">
	<?php
	foreach($this->_items as $item)
	{
		$image = $item->getOneFile('small');
		if ($image == '')
		{
			$image = Yii::app()->params['noimage'];
		}

		echo
			'<div class="item">
                <div class="col-xs-2 no-left">
                    <a href = "/'.$this->controller->getUrlById(Yii::app()->params['pages']['novosti']).'/'.$item->name.'">
                        <img src = "/'.$image.'" alt = "">
                    </a>
                </div>
                <div class="col-xs-10 no-right">
                    <a href = "/'.$this->controller->getUrlById(Yii::app()->params['pages']['novosti']).'/'.$item->name.'">
                        '.$item->preview.'
                    </a>
                    <span>'.date($this->dateFormat, $item->time).'</span>
                </div>
                <div class="clearfix"></div>
            </div>';
	}
	?>
</div>