<?php
    /* @var $this CatalogProductsController */
    /* @var $model CatalogProducts */
    /* @var $form BsActiveForm */

    echo $form->errorSummary($model);
?>

<?php echo $form->textField($model,'id', array('style'=>'display: none;', 'id' => 'product_id')); ?>
<div class="form-group col-xs-12">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title', array('placeholder'=>'')); ?>
    <?php echo $form->error($model,'title'); ?>
</div>

<div class="form-group col-xs-12">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name', array('placeholder'=>'')); ?>
    <?php echo $form->error($model,'name'); ?>
</div>

<div class="form-group col-xs-12">
    <div class="row">
        <div class="col-xs-3">
            <?php echo $form->labelEx($model, 'price', array('label' => 'Цена (USD)')); ?>
            <?php echo $form->textField($model, 'price', array('placeholder'=>'')); ?>
            <?php echo $form->error($model, 'price'); ?>
        </div>
        <div class="col-xs-1 mar_t">
            <label>USD</label>
        </div>
        <div class="col-xs-3">
            <?php echo $form->labelEx($model,'article'); ?>
            <?php echo $form->textField($model,'article', array('placeholder'=>'')); ?>
            <?php echo $form->error($model,'article'); ?>
        </div>
        <div class="col-xs-3">
            <?php echo $form->labelEx($model,'count'); ?>
            <?php echo $form->textField($model,'count', array('placeholder'=>'')); ?>
            <?php echo $form->error($model,'count'); ?>
        </div>
        <div class="col-xs-2 mar_t">
            <?php echo BsHtml::dropDownList('unit_id',$model->unit_id,array('шт','кг','л'),array('empty'=>'-')); ?>
        </div>
    </div>
</div>

<div class="form-group col-xs-12">
    <div class="row">
        <div class="col-xs-3">
            <?php echo $form->labelEx($model, 'price_eur', array('label' => 'Цена (EUR)')); ?>
            <?php echo $form->textField($model, 'price_eur', array('placeholder'=>'')); ?>
            <?php echo $form->error($model, 'price_eur'); ?>
        </div>
    </div>
</div>

<div class="form-group col-xs-12">
    <div class="row">
        <div class="col-xs-3">
            <?php echo $form->labelEx($model, 'price', array('label' => 'Тип')) ;?>
            <?php echo BsHtml::dropDownList('count','',array('Розница', 'Опт'),array('empty'=>'-')); ?>
        </div>
        <div class="col-xs-4">
            <?php echo $form->labelEx($model,'stock'); ?>
            <?php echo BsHtml::dropDownList('stock',$stock[0],array('Есть на складе','Нет на складе'),array('empty'=>'-')); ?>
        </div>
        <div class="col-xs-2" hidden >
            <?php echo BsHtml::label('Дней', 'days'); ?>
            <?php echo BsHtml::textField('days',$stock[1], array('placeholder'=>'', 'class'=>'form-control')); ?>
        </div>
        <div class="col-xs-3 mar_t" hidden>
            <label>доставки на склад</label>
        </div>
    </div>
</div>

<div class="form-group col-xs-12">
    <div class="title">Настройки цены</div>
    <div class="add_sale add" <?php if(!empty($sale[0])) echo "hidden"; ?> >+ Настроить скидку</div>
    <div class="sale" <?php if(!empty($sale[0])) echo "style=display:block;";?>>
        <div class="row">
            <div class="col-xs-2">
                <?php echo BsHtml::label('Скидка','sale_value'); ?>
                <?php echo BsHtml::textField('sale_value',$sale[0], array('placeholder'=>'')); ?>
            </div>
            <div class="col-xs-2 mar_t">
                <?php echo BsHtml::dropDownList('sale_type',$sale[1],array('%','USD'),array('empty'=>'-')); ?>
            </div>
            <div class="col-xs-5 period">
                <?php echo BsHtml::label('Период действия скидки', 'date_from'); ?>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',
                            ),
                            'value'=>$sale[2],
                            'htmlOptions'=>array(
                                'class'=>'from form-control',
                                'name'=>'date_from'
                            ),
                        ));
                        ?>
                    &nbsp;-&nbsp;
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'dd.mm.yy',
                            ),
                            'value'=>$sale[3],
                            'htmlOptions'=>array(
                                'class'=>'to form-control',
                                'name'=>'date_to'
                            ),
                        ));
                        ?>
            </div>
            <div class="col-xs-3">
                <label>Цена со скидкой</label>
                <div class="sale_price"><?php echo CatalogProducts::model()->getSalePrice($model->price,$model->sale_info);?> <span>USD</span></div>
            </div>
        </div>
    </div>

    <div class="add_sale kind">+ Добавить вариант цены</div>

</div>

<div class="form-group col-xs-12">
    <div class="title">Размещение в группе товаров</div>
    <div class="row">
        <div class="col-xs-4 marker <?php if($model->new == 1) echo 'active'; ?>">
            <i class="fa <?php echo ($model->new == 1) ? 'fa-bookmark' : 'fa-bookmark-o';?>  fa-rotate-270 new "></i>
            <span>Новинки</span>
            <?php echo $form->checkBox($model,'new'); ?>
        </div>
        <div class="col-xs-4 marker <?php if($model->popular == 1) echo 'active'; ?>">
            <i class="fa <?php echo ($model->popular == 1) ? 'fa-bookmark' : 'fa-bookmark-o';?>  fa-rotate-270 popular"></i>
            <span>Спецпредложение</span>
            <?php echo $form->checkBox($model,'popular'); ?>
        </div>
        <div class="col-xs-4 marker <?php if($model->sale == 1) echo 'active'; ?>">
            <i class="fa <?php echo ($model->sale == 1) ? 'fa-bookmark' : 'fa-bookmark-o';?>  fa-rotate-270 sale_product"></i>
            <span>Скидка</span>
            <?php echo $form->checkBox($model,'sale'); ?>
        </div>
    </div>

</div>
<div class="form-group col-xs-12">
    <div class="title">Описательная информация</div>


    <?php echo $form->labelEx($model,'preview', array('placeholder'=>'')); ?>
    <?php
    $this->widget('application.widgets.ImperaviRedactorWidget',array(
        'model'=>$model,
        'attribute'=>'preview',
        'plugins' => array(
            'imagemanager' => array(
                'js' => array('imagemanager.js',),
            ),
            'filemanager' => array(
                'js' => array('filemanager.js',),
            ),
            'fullscreen'=>array(
                'js'=>array('fullscreen.js'),
            ),
            'table'=>array(
                'js'=>array('table.js'),
            ),
        ),
        'options'=>array(
            'lang'=>Yii::app()->language,
            'imageUpload'=>$this->createUrl('admin/imageImperaviUpload'),
            'imageManagerJson'=>$this->createUrl('admin/imageImperaviJson'),
            'fileUpload'=>$this->createUrl('admin/fileImperaviUpload'),
            'fileManagerJson'=>$this->createUrl('admin/fileImperaviJson'),
            'uploadFileFields'=>array(
                'name'=>'#redactor-filename'
            ),
            'changeCallback'=>'js:function()
                {
                    viewSubmitButton(this.$element[0]);
                }',
            'buttonSource'=> true,
        ),
    ));
    ?>
    <?php echo $form->error($model,'preview'); ?>


    <?php echo $form->labelEx($model,'text', array('placeholder'=>'')); ?>
    <?php
        $this->widget('application.widgets.ImperaviRedactorWidget',array(
            'model'=>$model,
            'attribute'=>'text',
            'plugins' => array(
                'imagemanager' => array(
                    'js' => array('imagemanager.js',),
                ),
                'filemanager' => array(
                    'js' => array('filemanager.js',),
                ),
                'fullscreen'=>array(
                    'js'=>array('fullscreen.js'),
                ),
                'table'=>array(
                    'js'=>array('table.js'),
                ),
            ),
            'options'=>array(
                'lang'=>Yii::app()->language,
                'imageUpload'=>$this->createUrl('admin/imageImperaviUpload'),
                'imageManagerJson'=>$this->createUrl('admin/imageImperaviJson'),
                'fileUpload'=>$this->createUrl('admin/fileImperaviUpload'),
                'fileManagerJson'=>$this->createUrl('admin/fileImperaviJson'),
                'uploadFileFields'=>array(
                    'name'=>'#redactor-filename'
                ),
                'changeCallback'=>'js:function()
                {
                    viewSubmitButton(this.$element[0]);
                }',
                'buttonSource'=> true,
            ),
        ));
    ?>
    <?php echo $form->error($model,'text'); ?>

</div>



<div class="form-group col-xs-12">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->dropDownList($model,'status',$model->getStatus()); ?>
    <?php echo $form->error($model,'status'); ?>
</div>


<div class="form-group col-xs-12">
    <div class="title">Загрузка изображений товара</div>
<?php
        $this->widget('application.extensions.EFineUploader.EFineUploader',
            array(
                'id' => 'FineUploaderLogo',
                'config' => array(
                    'button' => "js:$('.download_image')[0]",
                    'autoUpload' => true,
                    'request' => array(
                        'endpoint' => $this->createUrl($this->id.'/upload'),
                        'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                    ),
                    'retry' => array('enableAuto' => true, 'preventRetryResponseProperty' => true),
                    'chunking' => array('enable' => true, 'partSize' => 100),
                    'callbacks' => array(
                        'onComplete' => 'js:function(id, name, response)
                                            {
                                                if (response["success"])
                                                {
                                                    $(".images .thumbnails").append("<li class=\"image\" style=\"float: left;\"><input type=\"hidden\" name=\"'.get_class($model).'['.$model->getFilesAttrName().'][]\" value=\""+response["folder"]+response["filename"]+"\"><img src=\"/"+response["folder"]+response["filename"]+"\" width=\"130\" height=\"130\" /><img class=\"close-img fa-close\" src=\"/images/icon-admin/close_photo.png\"></li>")
                                                }
                                            }',
                    ),
                    'validation' => array(
                        'allowedExtensions' => array('jpg', 'jpeg', 'png'),
                        'sizeLimit' => 3 * 1024 * 1024,
                    ),
                    'text' => array(
                        'uploadButton' => Yii::t('app', 'Upload a file'),
                        'dragZone' => Yii::t('app', 'Drop files here to upload') . '<br/><br/> или',
                    ),
                )
            )
        );

        Yii::app()->getClientScript()->registerScript("remove_image",
            "$('body').on('click','.images-block .fa-close', function()
                {
                    $(this).closest('.image').remove();
                });
            ");

        $images_for_key = array(); //для проверки по ключу, наличия картинки
        $images = @unserialize($model->images);

        $image_result = $images && is_array($images);
        $image_attr_name =  $model->getFilesAttrName();;
        $form_class = get_class($model);

        if ($image_result)
        {
            $count = count($images);
            for ($i = 0; $i < $count; $i++)
            {
                $images[$i] = array(
                    'path' => $images[$i]['path'].'small/'.$images[$i]['name'], //для отображение в теге img
                    'name' => $images[$i]['path'].$images[$i]['name'] //сама картинка без учета размера
                );

                $images_for_key[$images[$i]['name']] = $images[$i];
            }
        }

        if(isset($_POST[$form_class][$image_attr_name]))
        {
            $images = $_POST[$form_class][$image_attr_name];
            $count = count($images);
            for ($i = 0; $i < $count; $i++)
            {
                $images[$i] = array(
                    'path' => ((isset($images_for_key[$images[$i]])) ? $images_for_key[$images[$i]]['path'] : $images[$i]), // проверка если нет в массиве, то это новая картинка
                    'name' => $images[$i],
                );
            }
            $image_result = $images && is_array($images);
        }

        echo
            '<div class="images-block">
                    <div class="images">
                        <ul class="thumbnails row">';

                            if ($image_result)
                            {
                                $count = count($images);

                                for ($i = 0; $i < $count; $i++)
                                {
                                    if(isset($images[$i]['path']) && is_file($images[$i]['path']))
                                    {
                                        echo
                                            '<li class="image" style="float: left;">'.$model->gridImage($images[$i]['path'], '', array('width' => '130', 'height' => '130')).
                                            '<input type="hidden" name="'.$form_class.'['.$image_attr_name.'][]" value="'.$images[$i]['name'].'"><img class="close-img fa-close" src="/images/icon-admin/close_photo.png">
                                                            </li>';
                                    }
                                    else
                                    {
                                        echo '<img style="position: absolute;" src="/'.Yii::app()->params['no-image'].'" id="avatar" width="130" />';
                                    }
                                }
                            }
                            else
                            {
                                echo '<img style="position: absolute;" src="/'.Yii::app()->params['no-image'].'" id="avatar" width="130" />';
                            }
            echo
                '</ul>
            </div>
        </div>';
?>
</div>

<div class="form-group col-xs-12 seo">
    <div class="title"><?php echo Yii::t('app','Seo tags'); ?></div>
    <?php echo $form->labelEx($model,'seo_title'); ?>
    <?php echo $form->textArea($model,'seo_title', array('placeholder'=> 'Товары и услуги компании "IdeaWebLab"' )); ?>
    <?php echo $form->error($model,'seo_title'); ?>
</div>

<div class="form-group col-xs-12 seo">
    <?php echo $form->labelEx($model,'seo_keywords'); ?>
    <?php echo $form->textArea($model,'seo_keywords',array('placeholder'=> 'Товары и услуги компании "IdeaWebLab"' )); ?>
    <?php echo $form->error($model,'seo_keywords'); ?>
</div>

<div class="form-group col-xs-12 seo">
    <?php echo $form->labelEx($model,'seo_description'); ?>
    <?php echo $form->textArea($model,'seo_description',array('placeholder'=> 'Товары и услуги компании "IdeaWebLab"')); ?>
    <?php echo $form->error($model,'seo_description'); ?>
</div>