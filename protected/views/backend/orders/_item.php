<a href="<?php echo $this->createUrl('order',array('id'=>$data->id)) ?>" class="row item">
    <div class="c-num text-center"> <?php echo $data->id ?> </div>
    <div class="c-date text-center"> <?php echo $data->f_create_time ?> </div>
    <div class="c-client">
        <div class="name"><span class="icon-admin-user"></span> <?php echo $data->user->getFullName(); ?></div>
        <div class="phone"><span class="icon-admin-phone"></span> <?php echo (isset($data->user->user_info)) ? $data->user->user_info->phone : ''; ?></div>
        <div class="email"><span class="icon-admin-email"></span> <?php echo $data->user->email; ?></div>
        <?php
            if (isset($data->user->user_info))
            {
        ?>
        <div class="status s<?php echo $data->user->user_info->status ?>"><?php echo UserInfo::getStatus($data->user->user_info->status); ?></div>
        <?php
            }
        ?>
    </div>
    <div class="c-sum">
        <div class="text-right"><?php echo $data->count; ?> <span class="text-gray4">шт.</span></div>
        <div class="text-right"><span class="text-blue2"><?php echo $data->f_sum; ?></span> <span class="text-gray4">BYR</span></div>
        <div class="status"><div data-toggle="tooltip" data-placement="bottom" title="<?php echo Orders::getPaid($data->paid); ?>" class="order-status-paid<?php echo $data->paid; ?>"></div></div>
    </div>
    <div class="c-worker">
        <div> <?php echo $data->manager_id ? $data->manager->getFullName() : '-'  ?> </div>
        <div> <?php echo $data->picker_id ? $data->picker->getFullName() : '-'  ?> </div>
        <div> <?php echo $data->executor_id ? $data->executor->getFullName() : '-'  ?> </div>
    </div>
    <div class="c-status">
        <div>
            <?php
            if($data->status <= 0)
            {
                echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($data->status).'" class="order-status'.$data->status.'"></div>';
            }
            elseif($data->status == Orders::STATUS_COMPLETED)
            {
                echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($data->status).'" class="order-status'.$data->status.' '.$data->status.'"></div>';
            }
            else
            {
                for($i = Orders::STATUS_OK; $i <= Orders::STATUS_COMPLETED; $i++)
                {
                    echo '<div data-toggle="tooltip" data-placement="bottom" title="'.Orders::getStatus($i).'" class="order-status'.$i.' '.($i>$data->status ? 'inactive' : '').'"></div>';
                }
            }
            ?>
        </div>
        <div class="info">
            <div class="left text-gray4">
                <?php
                $flag = 0;
                if($data->status != Orders::STATUS_COMPLETED && $data->status > 0)
                {
                    $flag = 1;
                    echo 'Осталось:';
                }
                else
                {
                    echo 'Завершен:';
                }

                if($data->type_delivery == Orders::ORDER_DELIVERY_TO_ADDRESS)
                {
                    echo '<div class="icon-admin-delivery" data-toggle="tooltip" data-placement="bottom" title="'.Orders::getTypeDelivery($data->type_delivery).'"></div>';
                }
                else
                {
                    echo '<div class="icon-admin-self-pickup" data-toggle="tooltip" data-placement="bottom" title="'.Orders::getTypeDelivery($data->type_delivery).'"></div>';
                }

                ?>

            </div>
            <div class="right">
                <div>
                    <?php
                        if($flag)
                        {
                            echo $data->f_delivery_end;
                        }
                        else
                        {
                            $date = explode(' ',$data->f_update_time);
                            if(isset($date[1]))
                            {
                                echo '<div data-toggle="tooltip" data-placement="bottom" title="'.$date[1].'" >'.$date[0].'</div>';
                            }
                        }
                    ?>
                </div>
                <div><?php echo $data->f_delivery_time ?></div>
                <div><?php echo $data->delivery_hours ?></div>
            </div>
        </div>
    </div>
</a>
