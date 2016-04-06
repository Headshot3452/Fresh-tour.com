<?php


//var_dump($data);
//var_dump($data->user_id);
if ($data->user) {
    $image = $data->user->getOneFile('small');
    $image_block = $image ? "<div class='col-xs-3' style='background:url(/$image) center center no-repeat; background-size: contain; width:60px; height:60px;'></div>" : '';
//    $id_user ='<div class="user">'.$data->user->getFullname?:'N/A'.'</div>';
}
?>
<li class="col-xs-8 one_item">
    <div class="row client-info">
        <div class="col-xs-9">
            <?php echo $image_block ?: ''; ?>
            <div class="user">
                <?php echo $data->user ? $data->user->user_info->getFullName() : ($data->fullname ?: 'N/A'); ?>
            </div>
            <div class="time">
                <?php echo date('d.m.Y в H:i', $data->create_time); ?>
            </div>
        </div>
        <div class="col-xs-3 text-right">
            <div class="rating row">
                <?php
                for ($i = 1; $i < 6; $i++) {
                    echo '<i class="fa fa-star';
                    if ($i > $data->rating)
                        echo '-o';
                    echo '"></i>';
                }
                ?>
            </div>
            <div class="row rating-info"><?php echo $data->rating . ' ' . $data->getRating($data->rating); ?></div>
        </div>

    </div>
    <div class="row review">
        <div class="col-xs-12 theme">
            <?php echo $data->theme->title; ?>
        </div>
        <div class="col-xs-12 text">
            <?php echo $data->text; ?>
        </div>
    </div>

    <!--    <div class="col-xs-1 text-center" id="--><?php //echo $data->id; ?><!--">-->
    <!--        <!--                <div class="">-->
    <!--        <div>--><?php //echo $data->id; ?><!--</div>-->
    <!--        --><?php //echo BsHtml::checkBox('checkbox[' . $data->id . ']', false, array('class' => 'checkbox group')); ?>
    <!--        --><?php //echo BsHtml::label('', 'checkbox_' . $data->id, false, array('class' => 'checkbox')); ?>
    <!--        <div>--><?php //echo date("d.m.Y H:m", $data->create_time); ?><!--</div>-->
    <!--        <!--                </div>-->
    <!--    </div>-->
    <!--    <div onclick="location.href='--><?php //echo $link; ?>
    <!--//        <div class="user">-->
    <!--//            <img src="/images/icon-admin/little_user_company.png"/>-->
    <!--//            --><?php ////echo $data->user ? $data->user->getFullName() : $data->fullname ?: '--'; ?>
    <!--        </div>-->
    <!--        <div class="phone">-->
    <!--            <img src="/images/icon-admin/little_phone.png"/>-->
    <!--            --><?php //echo $data->user ? $data->user->user_info->phone : $data->phone ?: '--'; ?>
    <!--        </div>-->
    <!--        <div class="mail">-->
    <!--            <img src="/images/icon-admin/little_message_company.png"/>-->
    <!--            --><?php //echo $data->user ? $data->user->email : $data->email ?: '--'; ?>
    <!--        </div>-->
    <!--        <div class="rating">-->
    <!--            --><?php
    //            for ($i = 1; $i < 6; $i++) {
    //                echo '<i class="fa fa-star';
    //                if ($i > $data->rating)
    //                    echo '-o';
    //                echo '"></i>';
    //            }
    //
    ?>
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div onclick="location.href='--><?php //echo $link; ?>
    <?php //echo $data->theme->title ?>
    <!--    </div>-->
    <!--    <div onclick="location.href='--><?php //echo $link; ?>
    <?php //echo $data->text; ?>
    <!--    </div>-->
</li>
