<?php
    $total=0;
?>

<table class="table">
    <tbody>
    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->user? $model->user->getAttributeLabel('login'): $model->getAttributeLabel('email'); ?></td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->user? $model->user->login : $model->email; ?></div></td>
    </tr>
    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('phone'); ?></td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->phone; ?></div></td>
    </tr>
    <?php
        $info = unserialize($model->info);
        if($info)
        {
            if(!empty($info['fio']))
            {?>
                <tr>
                    <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo Yii::t('app','User name'); ?></td>
                    <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $info['fio']; ?></div></td>
                </tr>
            <?php }


            if(!empty($info['city']))
            {?>
                <tr>
                    <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo Yii::t('app','City'); ?></td>
                    <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $info['city']; ?></div></td>
                </tr>
            <?php }

            if(!empty($info['address']))
            {?>

                <tr>
                    <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo Yii::t('app','Address'); ?></td>
                    <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $info['address']; ?></div></td>
                </tr>

            <?php }

        }
    ?>

    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;"><?php echo $model->getAttributeLabel('comment'); ?></td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $model->comment; ?></div></td>
    </tr>
    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;">Товары</td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;">
            <div class="input-xlarge">
                <?php
                    foreach($model->orderItems as $item)
                    {
                        $item_price=$item->count*$item->price;
                        $total+=$item_price;

                        echo  $item->product_id.': '.$item->title.' количество - '.$item->count.'шт. по цене - '.$item->price.' итог: '.$item_price.'<br>';
                    }
                ?>
            </div>
        </td>
    </tr>
    <tr>
        <td style="text-align:right;width:110px;border:solid 1px #999999;padding: 4px 6px 4px 6px;">Итоговая сумма</td>
        <td style="border:solid 1px #999999;padding: 4px 6px 4px 6px;"><div class="input-xlarge"><?php echo $total; ?></div></td>
    </tr>
    </tbody>
</table>