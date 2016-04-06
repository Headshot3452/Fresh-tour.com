<h3 class="lk_title">Профиль покупателя</h3>

<?php
    $image = $user->getOneFile('small');

    if(!$image)
    {
        $image = Yii::app()->params['noavatar'];
    }
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-info-index-form',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'htmlOptions'=>array(
            'class'=>"form-horizontal",
        ),
    ));

    $this->widget('ext.EFineUploader.EFineUploader',
        array(
            'id'=>'FineUploader',
            'config'=>array(
                'button'=>"js:$('#load-avatar')[0]",
                'autoUpload'=>true,
                'request'=>array(
                    'endpoint'=>$this->createUrl($this->id.'/upload'),
                    'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                ),
                'retry'=>array('enableAuto' => true, 'preventRetryResponseProperty' => true),
                'chunking'=>array('enable' => true, 'partSize' => 100),
                'callbacks'=>array(
                    'onComplete'=>'js:function(id, name, response){ if (response["success"]) { $("#avatar").attr("src","/"+response["folder"]+response["filename"]).attr("width","70"); '
                        . '$(".avatar").find("input[type=hidden]").remove();$(".avatar").find("i").remove();'
                        . '$(".avatar").append("<input type=\"hidden\" name=\"'.get_class($user).'['.$user->getFilesAttrName().'][]\" value=\""+response["folder"]+response["filename"]+"\"><i class=\"icon-remove\"></i>") } }',
                    'onError'=>"js:function(id, name, errorReason){ }",
                ),
                'validation'=>array(
                    'allowedExtensions'=>array('jpg','jpeg'),
                    'sizeLimit'=>3 * 1024 * 1024,
                    //'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                ),
            )
        ));

    Yii::app()->getClientScript()->registerScript("removeavatar"," $('body').on('click','.avatar .fa-close',function(){
                                                                        $('#avatar').attr('src','/".Yii::app()->params['noavatar']."');
                                                                        $('.avatar').find('input[type=hidden]').val('');
                                                                        $(this).remove();
                                                                });");

    //определяем какую аватарку отдать
    $avatars = @unserialize($user->avatar);
    $ava_result = $avatars && is_array($avatars);
    if($ava_result)
    {
        $avatar_value = $avatars[0]['path'].$avatars[0]['name'];
    }

    $image_attr_name = $user->getFilesAttrName();
    $form_class = get_class($user);
    if(isset($_POST[$form_class][$image_attr_name][0]))
    {
        $post_avatar = $_POST[$form_class][$image_attr_name][0];
    }

    if ($ava_result && (!$user_info->hasErrors()||(isset($post_avatar)&&$post_avatar==$avatar_value)))
    {
        $avatar=array('img'=>$avatars[0]['path'].'small/'.$avatars[0]['name'],
            'value'=>$avatar_value
        );
    }
    elseif(isset($post_avatar)) //attr_items это имя поля, где лежит tmp путь к картинке
    {
        $avatar=array('img'=>$post_avatar,
            'value'=>$post_avatar
        );
    }

    $avatar_block = '<div class="avatar">';
    if (isset($avatar) && is_array($avatar))
    {
        $avatar_block.= $user->gridImage($avatar['img'],'',array('id'=>'avatar','width'=>'100%')).
            '<input type="hidden" name="'.get_class($user).'['.$user->getFilesAttrName().'][]" value="'.$avatar['value'].'">'
            . '<i class="fa fa-close"></i>';
    }
    else
    {
        $avatar_block.= '<img src="/'.Yii::app()->params['noavatar'].'" id="avatar" width="100%" />';
    }

    $avatar_block.= '</div>';
?>

    <div class="form-group photo_place">
        <div class="col-xs-2 text-right">
            Фото:
        </div>
        <div class="col-xs-2">
<!--            <img src="/--><?php //echo $image ?><!--" width="100%"/>-->
            <div class=""><?php echo $avatar_block; ?></div>
            <div><span id="load-avatar"><span class="fa fa-picture-o"></span> Загрузить новую фотографию </span></div>
        </div>
        <div class="clearfix"></div>
    </div>

<!--    <div class="form-group row">-->
<!--        <div class="col-xs-3 label-block">Фотография</div>-->
<!--        <div class="col-xs-6">-->
<!--            <div class="col-xs-3">--><?php //echo $avatar_block; ?><!--</div>-->
<!--            <div class="col-xs-9"><span id="load-avatar"><span class="fa fa-picture-o"></span> Загрузить новую фотографию </span></div>-->
<!--        </div>-->
<!--        <div class="col-xs-3"></div>-->
<!--    </div>-->

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $form->labelEx($user_info,'name'); ?>
        </div>
        <div class="col-xs-5">
            <?php echo $form->textField($user_info,'name', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($user_info,'name'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $form->labelEx($user_info,'last_name'); ?>
        </div>
        <div class="col-xs-5">
            <?php echo $form->textField($user_info,'last_name', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($user_info,'last_name'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $form->labelEx($user_info,'patronymic'); ?>
        </div>
        <div class="col-xs-5">
            <?php echo $form->textField($user_info,'patronymic', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($user_info,'patronymic'); ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right birth-label">
            <?php echo $form->labelEx($user_info,'birth'); ?>
        </div>
        <div class="col-xs-5 all date-block">
            <div class="col-xs-4 field-note">
                <label>Число</label>
                <?php echo $form->dropDownList($user_info,'birth_day',array_combine(range(1, 31),range(1, 31)),array('class'=>"form-control")); ?>
            </div>
            <div class="col-xs-4 field-note">
                <label>Месяц</label>
                <?php echo $form->dropDownList($user_info,'birth_month',array_combine(range(1, 12),range(1, 12)),array('class'=>"form-control")); ?>
            </div>
            <div class="col-xs-4 field-note">
                <label>Год</label>
                <?php echo $form->dropDownList($user_info,'birth_year',array_combine(range(date('Y')-18, 1910),range(date('Y')-18, 1910)),array('class'=>"form-control")); ?>
            </div>
            <div class="col-xs-4"> <?php echo $form->error($user_info,'birth'); ?></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="form-group">
        <div class="col-xs-2 text-right">
            <?php echo $form->labelEx($user_info,'phone'); ?>
        </div>
        <div class="col-xs-5">
            <?php echo $form->textField($user_info,'phone', array('class'=>'form-control', 'placeholder'=>'')); ?>
            <?php echo $form->error($user_info,'phone'); ?>
        </div>
        <div class="clearfix"></div>
    </div>


    <div class="form-group">
        <div class="col-xs-2"></div>
        <div class="col-xs-4"> <?php echo BsHtml::submitButton('Сохранить',
                array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'class'=>'btn-sm')
            ); ?>
        </div>
        <div class="col-xs-4"></div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->