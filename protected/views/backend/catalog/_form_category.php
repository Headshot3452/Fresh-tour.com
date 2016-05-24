<?php
    /* @var $this CatalogTreeController */
    /* @var $model CatalogTree */
    /* @var $form Model */
?>

<div class="form">

<?php
    $form = $this->beginWidget('BsActiveForm',
        array(
            'id' => 'catalog-tree-form-form',
            'enableAjaxValidation' => false,
        )
    );
    echo $form->errorSummary($model);
?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'padej'); ?>
        <?php echo $form->textField($model, 'padej'); ?>
        <?php echo $form->error($model, 'padej'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'popular'); ?>
        <?php echo $form->checkBox($model, 'popular', array('class' => 'visible')); ?>
        <?php echo $form->error($model, 'popular'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'preview'); ?>
<?php
        $this->widget('application.widgets.ImperaviRedactorWidget',
            array(
                'model' => $model,
                'attribute' => 'preview',
                'plugins' => array(
                    'imagemanager' => array(
                        'js' => array('imagemanager.js',),
                    ),
                    'filemanager' => array(
                        'js' => array('filemanager.js',),
                    ),
                    'fullscreen' => array(
                        'js' => array('fullscreen.js'),
                    ),
                    'table' => array(
                        'js' => array('table.js'),
                    ),
                ),
                'options' => array(
                    'lang' => Yii::app()->language,
                    'imageUpload' => $this->createUrl('admin/imageImperaviUpload'),
                    'imageManagerJson' => $this->createUrl('admin/imageImperaviJson'),
                    'fileUpload' => $this->createUrl('admin/fileImperaviUpload'),
                    'fileManagerJson' => $this->createUrl('admin/fileImperaviJson'),
                    'uploadFileFields' => array(
                        'name' => '#redactor-filename'
                    ),
                    'changeCallback' => 'js:function()
                    {
                        viewSubmitButton(this.$element[0]);
                    }',
                    'buttonSource' => true,
                ),
            )
        );
?>
        <?php echo $form->error($model,'preview'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'text'); ?>
<?php
        $this->widget('application.widgets.ImperaviRedactorWidget',
            array(
                'model' => $model,
                'attribute' => 'text',
                'plugins' => array(
                    'imagemanager' => array(
                        'js' => array('imagemanager.js',),
                    ),
                    'filemanager' => array(
                        'js' => array('filemanager.js',),
                    ),
                    'fullscreen' => array(
                        'js' => array('fullscreen.js'),
                    ),
                    'table' => array(
                        'js' => array('table.js'),
                    ),
                ),
                'options' => array(
                    'lang' => Yii::app()->language,
                    'imageUpload' => $this->createUrl('admin/imageImperaviUpload'),
                    'imageManagerJson' => $this->createUrl('admin/imageImperaviJson'),
                    'fileUpload' => $this->createUrl('admin/fileImperaviUpload'),
                    'fileManagerJson' => $this->createUrl('admin/fileImperaviJson'),
                    'uploadFileFields' => array(
                        'name' => '#redactor-filename'
                    ),
                    'changeCallback' => 'js:function()
                    {
                        viewSubmitButton(this.$element[0]);
                    }',
                    'buttonSource' => true,
                ),
            )
        );
?>
        <?php echo $form->error($model,'text'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'map'); ?>
        <?php echo $form->textField($model, 'map'); ?>
        <?php echo $form->error($model, 'map'); ?>
    </div>

    <div class="form-group">
        <span>1. Картинка, 2. Флаг, 3. Иконка</span><br/><br/>
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

        if($model->country_near)
        {
            $model->country_near = unserialize($model->country_near);

            $all_countrys = $model->getCountry();

            if(($key = array_search($model->title, $all_countrys)) !== FALSE)
            {
                unset($all_countrys[$key]);
            }
        }
?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'capital'); ?>
        <?php echo $form->textField($model, 'capital'); ?>
        <?php echo $form->error($model, 'capital'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'language'); ?>
        <?php echo $form->textField($model, 'language'); ?>
        <?php echo $form->error($model, 'language'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'currency'); ?>
        <?php echo $form->textField($model, 'currency'); ?>
        <?php echo $form->error($model, 'currency'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'difference'); ?>
        <?php echo $form->textField($model, 'difference'); ?>
        <?php echo $form->error($model, 'difference'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'viza'); ?>
        <?php echo $form->dropdownlist($model, 'viza', CatalogProducts::model()->getViza(), array('empty' => '-')); ?>
        <?php echo $form->error($model, 'viza'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'viza_info', array('label' => 'Виза по прилёту')); ?>
        <?php echo $form->checkbox($model, 'viza_info', array('class' => 'visible')); ?>
        <?php echo $form->error($model, 'viza_info'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'country_near'); ?>
        <?php echo $form->dropDownList($model, 'country_near', $all_countrys, array('class' => 'selectpicker', 'data-size' => '10', 'multiple' => true, 'title' => "Выберите страны")); ?>
        <?php echo $form->error($model, 'country_near'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', $model->getStatus()); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <h3><?php echo Yii::t('app', 'Seo tags'); ?></h3>

    <div class="form-group">
        <?php echo $form->labelEx($model,'seo_title'); ?>
        <?php echo $form->textField($model,'seo_title'); ?>
        <?php echo $form->error($model,'seo_title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'seo_keywords'); ?>
        <?php echo $form->textField($model,'seo_keywords'); ?>
        <?php echo $form->error($model,'seo_keywords'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'seo_description'); ?>
        <?php echo $form->textArea($model,'seo_description'); ?>
        <?php echo $form->error($model,'seo_description'); ?>
    </div>

    <div class="form-group buttons">
        <?php echo BsHtml::submitButton(Yii::t('app','Save'),array('color'=>BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        <span>Отмена</span>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerPackage('boot-select');