<div class="order-block">
    <div  class="order-info-block">
        <div class="row">
            <div class="col-xs-1 c-avatar">
                <?php
                    $avatar = @unserialize($order->user->avatar);
                    if($avatar && is_array($avatar))
                    {
                        $avatar = $order->user->getOneFile('small');
                        $img = '<img  src="/'.$avatar.'" />';
                    }
                    else
                    {
                        $img = '<img src="/'.Yii::app()->params['noavatar'].'" />';
                    }
                    echo $img;
                    echo '<div>#'.$order->user->id.'</div>'
                ?>
            </div>

            <div class="c-client col-xs-4">
                <div class="name"><?php echo $order->user->getFullName(); ?></div>
                <div class="phone"><?php echo (isset($data->user->user_info)) ? $data->user->user_info->phone : ''; ?></div>
                <div class="email"><?php echo $order->user->email; ?></div>
                <?php
                if (isset($data->user->user_info))
                {
                    ?>
                    <div class="status s<?php echo $data->user->user_info->status ?>"><?php echo UserInfo::getStatus($data->user->user_info->status); ?></div>
                <?php
                }
                ?>
            </div>

            <div class="c-status col-xs-3">
                <div class="title">Статус заказа</div>
                <div>
                    <?php
                    if($order->status <= 0)
                    {
                        echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($order->status).'" class="big order-status'.$order->status.'"></div>';
                    }
                    elseif($order->status == Orders::STATUS_COMPLETED)
                    {
                        echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($order->status).'" class="big order-status'.$order->status.' '.$order->status.'"></div>';
                    }
                    else
                    {
                        for($i = Orders::STATUS_OK; $i <= Orders::STATUS_COMPLETED; $i++)
                        {
                            echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($i).'" class="big order-status'.$i.' '.($i>$order->status ? 'inactive' : '').'"></div>';
                        }
                    }
                    ?>
                </div>
            </div>
            
            <div class="c-remain col-xs-2">
                <div class="title">
                    <?php
                    $flag = 0;
                    if($order->status != Orders::STATUS_COMPLETED && $order->status > 0)
                    {
                        $flag = 1;
                        echo 'Осталось';
                    }
                    else
                    {
                        echo 'Завершен';
                    }
                    ?>
                </div>

                <?php
                if($flag)
                {
                    echo $order->f_delivery_end;
                }
                else
                {
                    $date = explode(' ',$order->f_update_time);
                    if(isset($date[1]))
                    {
                        echo '<div data-toggle="tooltip" data-placement="bottom" title="'.$date[1].'" >'.$date[0].'</div>';
                    }
                }

                ?>
            </div>

            <div class="c-delivery col-xs-2">
                <div class="title">Время доставки</div>
                <div><?php echo $order->f_delivery_time ?> <?php echo $order->delivery_hours ?></div>
            </div>
        </div>
    </div>


    <div class="tabs-block">
        <?php
        $this->widget('BsNavs',array(
            'items'=>array(
                array(
                    'label'=> Yii::t('app', 'Common'),
                    'id'=>'tab-common',
                    'active'=>true,
                    'content'=>$this->renderPartial('_tab-common',array('order'=>$order,'managers'=>$managers,'workers'=>$workers),true)
                ),
                array(
                    'label'=> Yii::t('app', 'Order details'),
                    'id'=>'tab-details',
                    'active'=>false,
                    'content'=>$this->renderPartial('_tab-details',array('order'=>$order,'products'=>$products),true)
                ),
                array(
                    'label'=> Yii::t('app', 'Payment'),
                    'active'=>false,
                ),
                array(
                    'label'=> Yii::t('app', 'Feedback'),
                    'active'=>false,
                ),
                array(
                    'label'=> Yii::t('app', 'Event log'),
                    'active'=>false,
                ),
                array(
                    'label'=> Yii::t('app', 'Refusal'),
                    'active'=>false,
                ),
            )
        ));

        ?>
    </div>

</div>