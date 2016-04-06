<?php
//    $image;
    if ($model->user) {
        $image = $model->user->getOneFile('small');
//        if(!$image){
//            $image = Yii::app()->params['noimage'];
//        }
        $image_block=$image?"<div class='col-xs-3' style='background:url(/$image) center center no-repeat; background-size: contain; width:60px; height:60px;'></div>":'';
        $id_user ='<div class="number-user"><span class="number">#</span>'.$model->user->id.'<span class="user-status user-status-'. $model->user->status .'">'. $model->user->user_info->getStatus($model->user->status) .'</span></div>';
    }

?>    <?php
$form = $this->beginWidget('BsActiveForm', array(
    'id' => 'catalog-products-product-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of BsActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation' => false,
));
?>
<div class="col-xs-4 review-edit">
    <div class="row">
        Клиент
    </div>
    <div class="row client-info">
        <?php echo $image_block?:''; ?>
        <div class="col-xs-9 no-padding">
            <?php echo $id_user?:'';?>
            <div class="user">
                <img src="/images/icon-admin/little_user_company.png"/>  <?php echo $model->user?$model->user->user_info->getFullName():($model->fullname?:'--') ;?>
            </div>
            <div class="mail">
                <img src="/images/icon-admin/little_message_company.png"/>  <?php echo $model->user?$model->user->email:($model->email?:'--') ;?>
            </div>
            <div class="phone">
                <img src="/images/icon-admin/little_phone.png"/><?php echo $model->user?$model->user->user_info->phone:($model->phone?:'--') ;?>
            </div>
        </div>
    </div>
    <div class="row">
        Рейтинг
    </div>
    <div class="row rating">
        <?php
        for($i=1;$i<6;$i++){
            echo '<i class="fa fa-star';
            if($i>$model->rating)
                echo '-o';
            echo '"></i>';
        }
        ?>
        <div class="col-xs-12 rating-info"><?php echo $model->rating.' '.$model->getRating($model->rating);?></div>
    </div>
</div>
<div class="form col-xs-8 review-edit">


    <?php echo $this->renderPartial('_form', array('model' => $model, 'form' => $form), true, false); ?>

</div><!-- form -->
    <div class="form-group buttons">
        <?php echo BsHtml::submitButton(Yii::t('app', 'Save')); ?>
    </div>
<?php $this->endWidget(); ?>