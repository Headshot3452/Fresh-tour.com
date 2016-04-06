<div class="title-block">
    <a href="<?php echo isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : Yii::app()->createUrl('orders/index') ?>" class="menu-back"><span class="fa fa-angle-left"></span></a>
    <span class="title" style="margin-top: 0;">Заказ № <?php echo $order->id; ?></span>
    <div class="date">
        <?php echo $order->f_create_time; ?>
    </div>
</div>
<?php
Yii::app()->getClientScript()->registerScript('changestatus',
    '
                $(document).ready(function(){

                    $("#status").change(function(){
                        if(confirm("Вы уверены, что хотите сменить статус?"))
                        {
                            var id = $(this).find("option:selected").val();
                            $.ajax({
                               type: "POST",
                               url: "'.$this->createUrl('changeStatus').'?id='.$order->id.'&status="+id,
                               success: function(msg){
                                 window.location.reload();
                               }
                            });
                        }
                        return false;
                    });
                });
            '
);
?>
<div class="order-block">
    <div class="price-block">
        <div class="big order-status-paid<?php echo $order->paid; ?> " ></div>
        <div class="price">
            <span class="number"><?php echo Yii::app()->format->formatNumber($order->sum); ?> </span>
            <span class="cur">BYR</span>
        </div>
    </div>

    <div class="status-block">
        <div class="gray-title">
            Статус заказа:
        </div>
        <?php
            echo CHtml::dropDownList('status',$order->status,Orders::getStatus(),array('class'=>'form-control'));
        ?>
    </div>
</div>
<?php
?>