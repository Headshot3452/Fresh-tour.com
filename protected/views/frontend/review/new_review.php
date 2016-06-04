<?php
    /* @var $this ReviewController */
    /* @var $model ReviewItem */
    /* @var $form BsActiveForm */

    $cs = Yii::app()->getClientScript();
    $cs->registerCssFile(Yii::app()->getBaseUrl() . '/css/backend_manenok.css');
?>
<div class="head">
    <div class="container">
        <h2 class='col-xs-12'>
            Модуль Отзывы
        </h2>
    </div>
</div>

<div class="form">
    <div class="container">
<?php
        if ($setting[2]->status == 1 and Yii::app()->user->isGuest)
        {
            echo '<div><h3>Оставить отзыв могут только зарегистрированные пользователи!</h3></div>';
        }
        else
        {
            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm',
                array(
                    'id' => 'new-review',
                    'enableAjaxValidation' => false,
                )
            );
?>
            <div class="container">
                <h4>Добавить отзыв</h4>
            </div>
            <div class="clearfix"></div>

        <?php
//                    echo $form->errorSummary($review);
        if ($setting[0]->status == 1) {
            ?>
            <div class="form-group">
                <div class="col-xs-2 text-left">
                    <?php echo $form->labelEx($review, 'theme'); ?>
                </div>
                <div class="col-xs-6">
                    <?php echo $form->dropDownList($review, 'theme', ReviewThemesTree::getAllTreeFilter(), array('empty' => 'Выберите тему отзыва', 'class' => 'form-control', 'placeholder' => '')); ?>
                    <?php echo $form->error($review, 'theme'); ?>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php } ?>

        <?php if ($setting[6]->status == 0) {
            ?>
            <div class="form-group">
                <div class="col-xs-2 text-left">
                    <?php echo $form->labelEx($review, 'rating'); ?>
                </div>
                <div class="col-xs-6">
                    <?php
                    $this->widget('CStarRating', array(
                        'name' => get_class(ReviewItem::model()) . '[rating]',
                        'value' => '1',
                        'minRating' => 1,
                        'maxRating' => 5,
                        'titles' => ReviewItem::getRating(),
                    ));
                    ?>

                    <?php echo $form->error($review, 'rating'); ?>
                </div>
                <div class="clearfix"></div>
            </div>
        <?php
        } ?>

        <div class="form-group">
            <div class="col-xs-2 text-left">
                <?php echo $form->labelEx($review, 'text'); ?>
            </div>
            <div class="col-xs-6">
                <?php echo $form->textArea($review, 'text', array('class' => 'form-control', 'placeholder' => '')); ?>
                <?php echo $form->error($review, 'text'); ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php if ($setting[2]->status == 0 and Yii::app()->user->isGuest) {
            if ($setting[3]->status == 1) {
                ?>

                <div class="form-group">
                    <div class="col-xs-2 text-left">
                        <?php echo $form->labelEx($review, 'fullname'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $form->textField($review, 'fullname', array('class' => 'form-control', 'placeholder' => '')); ?>
                        <?php echo $form->error($review, 'fullname'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php
            }
            if ($setting[5]->status == 1) {
                ?>
                <div class="form-group">
                    <div class="col-xs-2 text-left">
                        <?php echo $form->labelEx($review, 'phone'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $form->textField($review, 'phone', array('class' => 'form-control', 'placeholder' => '+')); ?>
                        <?php echo $form->error($review, 'phone'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

            <?php
            }
            if ($setting[4]->status == 1) {
                ?>
                <div class="form-group">
                    <div class="col-xs-2 text-left">
                        <?php echo $form->labelEx($review, 'email'); ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $form->emailField($review, 'email', array('class' => 'form-control', 'placeholder' => '')); ?>
                        <?php echo $form->error($review, 'email'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php
            }
        } ?>

        <div class="clearfix"></div>

        <?php
        if (CCaptcha::checkRequirements()) {
            ?>
            <div class="form-group captcha">
                <div class="col-xs-6 col-xs-offset-2">
                    <div class="col-xs-3 captcha">
                        <?php $this->widget('CCaptcha', array(
                            'clickableImage' => true,
                            'buttonLabel' => '',
                            'buttonOptions' => array('class' => 'captcha-refresh blue_link')
                        )); ?>
                    </div>
                    <div class="col-xs-4">
                        <?php echo $form->textField($review, 'verifyCode', array('class' => 'form-control', 'placeholder' => '')); ?>
                        <?php echo $form->error($review, 'verifyCode'); ?>
                    </div>
                    <div class="col-xs-4 col-xs-offset-1 no-padding">
                        <?php
                        echo BsHtml::submitButton(Yii::t('app', 'Send'), array('id' => 'add_btn', 'class' => 'col-xs-9 col-xs-offset-3', 'color' => BsHtml::BUTTON_COLOR_SUCCESS));
                        ?>
                    </div>
                </div>
<!--                <div class="col-xs-4 captcha_error"></div>-->
                <div class="clearfix"></div>
            </div>
        <?php
        }
        ?>

        <div class="row buttons">
            <div class="form-group">
            </div>
            <div class="clearfix"></div>
        </div>

        <?php $this->endWidget(); ?>

    </div>
    <!-- form --><?php } ?>
</div>