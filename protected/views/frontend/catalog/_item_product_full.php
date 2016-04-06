<?php
if ($url=='')
{
    $url=$data->getUrlForItem($this->root_id,true);
}

$link=$this->createUrl('catalog/tree',array('url'=>$url.$data->name));

$image = $data->getOneFile('small');
if(!$image)
    $image = Yii::app()->params['noimage'];
?>

<div class="row">
    <div class="col-xs-2">
        <?php echo CHtml::link('<img  src="/'.$image.'" class="img-responsive">',$link); ?>
    </div>
    <div class="col-xs-6">
        <div class="product-title">
            <?php echo CHtml::link($data->title,$link); ?>
        </div>
    </div>
    <div class="col-xs-4">
        <input type="text" class="count" value="1"> шт.<br>
          <span class="price">
            <?php echo Yii::app()->format->formatNumber($data->price); ?>
         </span>
         <span class="addProduct" data-id="<?php echo $data->id; ?>" data-title="<?php echo $data->title; ?>" data-price="<?php echo $data->price; ?>" data-url="#"/></span>
    </div>
</div>