<?php
    $image = $data->getOneFile('small');
    if(!$image)
    {
        $image = Yii::app()->params['noimage'];
    }
    $sale_price = $data->getSalePrice($data->price, $data->sale_info);
?>

<div class="small catalog" id="products-list">
    <div class="one_item" id="<?php echo $data->id;?>">
        <div class="row">
            <div class="img-cont">
                <a href="/admin<?php echo $this->createUrl("catalog/") ;?>">
                    <img width="50" height="50" src="/<?php echo $image;?>" alt="" title="" />
                </a>
            </div>

            <div class="col-xs-5 name">
                <?php echo BsHtml::link($data->title,$this->createUrl('update_product').'?id='.$data->id); ?>
<?php
                if(!empty($data->article))
                {
?>
                    <div class="article">
                        <span>Арт.</span><?php echo $data->article; ?>
                    </div>
<?php
                }
?>
            </div>

            <div class="col-xs-3 text-right">
<?php
                if(!empty($sale_price))
                {
?>
                    <div class="price">
                        <?php echo $sale_price; ?>
                        <!-- Добавить текущую валюту из модуля "валюта"        -->
                        <span> USD </span>
                        <!-- -->
                    </div>
                    <div class="price_sale">
<?php
                        echo number_format($data->price, 2, '.', ' ');
?>
                        <!-- Добавить текущую валюту из модуля "валюта"        -->
                        <span> USD </span>
                        <!-- -->
                    </div>
<?php
                }
                else
                {
?>
                    <div class="price">
                        <?php echo number_format($data->price, 2, '.', ' '); ?>
                        <!-- Добавить текущую валюту из модуля "валюта"        -->
                        <span> USD </span>
                        <!-- -->
                    </div>
<?php
                }
?>
            </div>
            <div class="col-xs-1 deals">
                <?php if ($data->new == 1) echo '<i class="fa fa-bookmark fa-rotate-270 new"></i>'; ?>
                <?php if ($data->sale == 1) echo '<i class="fa fa-bookmark fa-rotate-270 sale_product"></i>'; ?>
                <?php if ($data->popular == 1) echo '<i class="fa fa-bookmark fa-rotate-270 popular"></i>'; ?>
            </div>
            <div class="col-xs-2">
                <a href="<?php echo $this->createUrl('active', array('id' => $data->id))?>" class="btn btn-small btn-active"><span class="icon-admin-power-switch-<?php echo ($data->status==CatalogProducts::STATUS_OK ? 'green' : 'red'); ?>"></span></a>
                <a href="<?php echo $this->createUrl('delete_product', array('id' => $data->id )) ?>" class="btn btn-small btn-trash"><span class="fa fa-trash-o"></span></a>
            </div>
        </div>
    </div>
</div>