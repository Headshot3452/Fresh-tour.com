<h3 class="lk_title">Профиль покупателя</h3>

<?php
    $image = $user->getOneFile('small');

    if(!$image)
    {
        $image = Yii::app()->params['noavatar'];
    }
?>

<div class="dl-lists" id="profil_settings">

    <div class="form-group">
        <div class="col-xs-2 text-right">
            Фото:
        </div>
        <div class="col-xs-2">
            <img src="/<?php echo $image ?>" width="100%"/>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user_info->getAttributeLabel('last_name') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::encode($user_info->last_name) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user_info->getAttributeLabel('name') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::encode($user_info->name) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user_info->getAttributeLabel('patronymic') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::encode($user_info->patronymic) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user_info->getAttributeLabel('birth') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy',$user_info->birth) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user->getAttributeLabel('email') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::encode($user->email) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $user_info->getAttributeLabel('phone') ;?>
        </div>
        <div class="col-xs-4">
            <?php echo CHtml::encode($user_info->phone) ;?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 col-xs-offset-2 text-right">
            <a href="<?php echo $this->createUrl('settingsEdit'); ?>" class="btn btn-primary">Редактировать</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>