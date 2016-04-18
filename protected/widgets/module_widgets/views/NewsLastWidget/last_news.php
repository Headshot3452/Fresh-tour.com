<div id="recently-news">
    <h2>Новости</h2>
<?php
        foreach($this->_items as $item)
        {
            $image = $item->getOneFile('small');
            if ($image == '')
            {
                $image = Yii::app()->params['noimage'];
            }
            echo
                '<a href="/'.$this->controller->getUrlById(Yii::app()->params['pages']['novosti']).'/'.$item->name.'">
                    <div class="item">
                        <div class="img-container">
                            <img src = "/'.$image.'" alt = "">
                        </div>
                        <h5>'.$item->preview.'</h5>
                        <div class="date">
                            '.date($this->dateFormat, $item->time).'
                        </div>
                    </div>
                </a>';
        }
?>
    <a href = "/<?php echo $this->controller->getUrlById(Yii::app()->params['pages']['novosti']) ;?>" class="all_news">Все новости</a>
</div>