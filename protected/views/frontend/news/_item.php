<?php
    $image = $data->getOneFile('small');
    $time_block = '';
    if(!$image)
    {
        $image = Yii::app()->params['noimage'];
    }

    if($this->page_id != Yii::app()->params['pages']['novosti'])
    {
        if(strtotime(date("Y-m-d H:i:s")) < $data->time)
        {
            $time_block = '<div class="soon"><span>Скоро</span>Состоится '.Yii::app()->dateFormatter->format('dd. MM. yyyy', $data->time).'</div>';
        }
        else
        {
            $time_block = '<div class="past"><span>Прошло</span>Состоялось '.Yii::app()->dateFormatter->format('dd. MM. yyyy', $data->time).'</div>';
        }
    }

    echo
        '<div class="col-xs-4">
            <div class="news-item">
                <div class="image-block">
                    <a href="'.$data->name.'"><img src="/'.$image.'" ></a>
                    '.$time_block.'
                </div>
                <div class="description-block">
                    <div class="create">'.Yii::app()->dateFormatter->format('dd. MM. yyyy', $data->create_time).'</div>
                    <div class="count">'.$data->count .' '. Yii::t('app', 'Visits', $data->count).'</div>
                    <div class="clearfix"></div>
                    <div class="title">'.CHtml::link($data->title, array($data->name),array('class'=>'black-link')).'</div>
                    <div class="anons">'.$data->preview.'</div>
                </div>
           </div>
        </div>';
?>
