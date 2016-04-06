<?php
/* @var $order Orders */
?>
<div class="row">
    <div class="col-xs-6">
        <div class="block-title">Доставка</div>

        <div class="form-horizontal">

                <?php
                if($order->address_text && ($address = @unserialize($order->address_text)))
                {
                    if(isset($address['username']))
                    {
                        echo '<div class="form-group">
                                <div class="col-xs-4 title">ФИО:</div>
                                <div class="col-xs-8">' . $address['username'] . '</div>
                            </div>';
                    }

                    if(isset($address['phone']))
                    {
                        echo '<div class="form-group">
                                <div class="col-xs-4 title">Телефон:</div>
                                <div class="col-xs-8">'.$address['phone'].'</div>
                            </div>';
                    }

                    if(isset($address['city_id']))
                    {
                        $city = City::model()->findByPk($address['city_id']);
                        $addr = $city ? $city->title.', ' : '';
                        $addr .= isset($address['street']) ? $address['street'].', ' : '';
                        $addr .= isset($address['house']) ? 'дом '.$address['house'].', ' : '';
                        $addr .= isset($address['apartment']) ? 'квартира '.$address['apartment'].' ' : '';

                        echo '<div class="form-group">
                                <div class="col-xs-4 title">Адрес:</div>
                                <div class="col-xs-8">'.$addr.'</div>
                            </div>';
                    }
                }

                echo '<div class="form-group">
                        <div class="col-xs-4 title">Комментарий клиента:</div>
                        <div class="col-xs-8">'.$order->comment.'</div>
                    </div>';

                ?>
            </div>
        </div>


    <div class="col-xs-6">
        <div class="block-title">Ответственный за обработку заказа</div>
        <div class="form-horizontal">
            <?php
                    echo '<div class="form-group">
                            <div class="col-xs-4 title">Менеджер:</div>
                            <div class="col-xs-8">'.BsHtml::dropDownList('manager',$order->manager_id,CHtml::listData($managers,'id','user_info.FullName'),array('empty'=>'-')).'</div>
                        </div>';

            $workers_for_role=CHtml::listData($workers,'id','name','role');

            echo '<div class="form-group">
                            <div class="col-xs-4 title">Комплектовщик:</div>
                            <div class="col-xs-8">'.BsHtml::dropDownList('picker',$order->picker_id,((isset($workers_for_role[Workers::ROLE_PICKER])) ? $workers_for_role[Workers::ROLE_PICKER] : array()),array('empty'=>'-')).'</div>
                        </div>';

            echo '<div class="form-group">
                            <div class="col-xs-4 title">Исполнитель:</div>
                            <div class="col-xs-8">'.BsHtml::dropDownList('executor',$order->executor_id,((isset($workers_for_role[Workers::ROLE_EXECUTOR])) ? $workers_for_role[Workers::ROLE_EXECUTOR] : array()),array('empty'=>'-')).'</div>
                        </div>';

            echo '<div class="form-group">
                            <div class="col-xs-4 title">Комментарий исполнителю:</div>
                            <div class="col-xs-8">'.BsHtml::textArea('comment').'</div>
                        </div>';
            ?>
        </div>
    </div>
</div>


<?php
if ($order->type_delivery!=Orders::ORDER_DELIVERY_NOT_ADDRESS && isset($addr))
{
?>
    <div class="row">
        <div class="block-title">Карта проезда:</div>
        <div class="" style="height: 400px">
            <?php
                $this->widget('application.widgets.module_widgets.MapForAddressWidget',array(
                        'address'=>'Республика Беларусь г.'.$addr,
                    )
                );
            ?>
        </div>
    </div>
<?php
}
?>