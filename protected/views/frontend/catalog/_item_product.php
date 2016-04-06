<?php
    if ($url == '')
    {
        $url = $data->getUrlForItem($this->root_id, true);
    }

    $link = $this->createUrl('catalog/tree', array('url' => $url.$data->name));

    $image = $data->getOneFile('original');

    if(!$image)
    {
        $image = Yii::app()->params['noimage'];
    }

    foreach($data->parameters_value as $value)
    {
        if($value["params_id"] == 3)
        {
            $type = $value["value"];
        }
        elseif($value["params_id"] == 2)
        {
            $srok = $value["value"];
        }
    }
?>

<a href = "<?php echo $data->name ;?>" class="item-link">
    <div class="item">
        <div class="col-xs-4 no-left img-cont">
            <img src = "/<?php echo $image ;?>" alt = "">
            <span class="hot count"><?php echo (isset($type)) ? $type : '' ;?></span>
            <h3>
                <?php echo $data->title ;?>
            </h3>
        </div>
        <div class="col-xs-8 no-right">
            <div class="row">
                <div class="col-xs-8">
                    <span class="srok">Срок оформления: <b><?php echo (isset($srok)) ? $srok : '' ;?></b></span>
                    <span class="doc">Документы: <br>
                        <b><?php echo $data->preview ;?></b>
                    </span>
                </div>
                <div class="col-xs-3 no-right price-cont">
                    <span class="price"><?php echo  Yii::app()->format->formatNumber($data->price) ;?> </span> руб
                </div>
                <div class="clearfix"></div>
                <a href = "<?php echo $data->name ;?>" class="forward">Подробнее</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</a>