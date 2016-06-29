<?php
    $form = $this->beginWidget('BsActiveForm',
        array(
            'id' => 'contacts-form',
            'htmlOptions' => array(
                'role'=>'form',
            ),
            'enableAjaxValidation'=>false,
            'action' => $this->createUrl('site/contacts'),
            'enableClientValidation' => true,
        )
    );
?>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('placeholder' => 'Иванов Иван Иванович')); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="form-group">
<?php
        echo $form->labelEx($model, 'phone');

        $this->widget('CMaskedTextField',
            array(
                'model' => $model,
                'attribute' => 'phone',
                'mask' => Yii::app()->params['phone']['mask'],
                'htmlOptions' => array(
                    'placeholder' => $model->getAttributeLabel('phone'),
                    'class' => 'form-control',
                )
            )
        );
?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'subject'); ?>
        <?php echo $form->dropdownlist($model, 'subject', array('0' => 'Любая', '1' => 'Тема 1', '2' => 'Тема 2')); ?>
        <?php echo $form->error($model,'subject'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textArea($model, 'message', array('placeholder' => 'Введите текст')); ?>
        <?php echo $form->error($model, 'message'); ?>
    </div>

    <div class="form-group button">
<?php
        echo BsHtml::ajaxSubmitButton(Yii::t('app','Send'),$this->createUrl('site/contacts'),array(
            'dataType' => 'json',
            'type' => 'POST',
                'beforeSend' => 'function()
                {
                    $("#contacts-form").find("button").attr("disabled","disabled");
                }',
                'success' => 'function(data)
                {
                    var form = $("#contacts-form");
                    if(data.status == "success")
                    {
//                        alert("'.Yii::t('app','Thank you for your message. Manager will contact you.').'");
                        form[0].reset();
                        location.reload();
                    }
                    else
                    {
                        $.each(data, function(key, val)
                        {
                            form.find("#"+key+"_em_").text(val).show();
                        });
                    }
                }',
                'complete'=>'function()
                {
                    $("#contacts-form").find("button").removeAttr("disabled");
                }',
            ),
            array(
                'class' => 'btn-primary'
            )
        )
?>
    </div>
    <?php $this->endWidget(); ?>
