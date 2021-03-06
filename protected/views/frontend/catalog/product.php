<div id="title-container" class="tyr-posad">
    <img src = "/images/title-img.png" alt = "">
    <div class="breadcrumbs-container">
        <div class="container">
            <div class="row">
                <div class="breadcrumbs">
<?php
                    $name_hotel = '';

                    $ico = ($product->price)
                        ? '<i class=" icon-prod '.$this->currency_usd->currencyName->icon.'"></i>'
                        : '<i class=" icon-prod '.$this->currency_eur->currencyName->icon.'"></i>';
                    $price = ($product->price) ? $product->price * $this->currency_byn->course : $product->price_eur * $this->currency_byn->course * $this->currency_eur->course;
                    $price_int = ($product->price) ? $product->price : $product->price_eur;

                    if (!isset($limit))
                    {
                        $limit = 2;
                    }
                    $session = Yii::app()->session;
                    $session->open();

                    if (!$session->get('viewed'))
                    {
                        $ids[] = $product->id;
                        $session->add('viewed', $ids);
                    }
                    else
                    {
                        $res = $session->get('viewed');
                        if (in_array($product->id, $res))
                        {
                            $key = array_search($product->id, $res);
                            unset($res[$key]);
                        }

                        $c = count($res);

                        if ($c > $limit)
                        {
                            array_shift($res);
                        }

                        $res[] = $product->id;

                        $session->add('viewed', $res);
                    }

                    $counter = 0;

                    if(!empty($this->breadcrumbs))
                    {
                        echo '<div>';

                            $this->widget('bootstrap.widgets.BsBreadcrumb',
                                array(
                                    'links' => $this->breadcrumbs,
                                )
                            );

                        echo '</div>';
                    }

                    foreach($this->breadcrumbs as $key => $value)
                    {
                        $counter++;
                        if($counter == 2)
                        {
                            $back = $value;
                            $country = $key;
                        }
                    }

                    $stars = $product->getStars();

                    $parameters = CatalogProductsParams::model()->findAll('product_id = :id', array(':id' => $product->id));

                    if($parameters)
                    {
                        $hot = false;
                        $popular = false;

                        foreach($parameters as $value)
                        {
                            switch($value->params_id)
                            {
                                case Yii::app()->params['vylet']:
                                    $vylet = $value->value['value'];
                                    break;
                                case Yii::app()->params['sostav']:
                                    $sostav = $value->value['value'];
                                    break;
                                case Yii::app()->params['pitanie']:
                                    $pitanie = $value->value['value'];
                                    break;
                                case Yii::app()->params['transport']:
                                    $transport = $value->value['value'];
                                    break;
                                case Yii::app()->params['dlitelnost']:
                                    $dlitelnost = $value->value['value'];
                                    break;
                                case Yii::app()->params['tema_tours']:
                                    $tema_tours[] = $value->value['value'];
                                    break;
                                case Yii::app()->params['hotel']:
                                    $hotel[] = $value->value['id'];
                                    break;
                                case Yii::app()->params['hot']:
                                    $hot = true;
                                    break;
                                case Yii::app()->params['popular']:
                                    $popular = true;
                                    break;
                                case Yii::app()->params['name_hotel']:
                                    $name_hotel = $value->value['value'];
                                    break;
                            }
                        }
                    }

                    $images = $tree->getFiles();

                    $image = next($images);

                    $flag = $image['path'].'small/'.$image['name'];
?>
                </div>
                <a href = "<?php echo $back ;?>" class="back-to-country">К списку туров</a>
                <div id="bonus-cont">
<?php
                    echo $hot ? '<span class = "hot">Горящий тур</span>' : '';
                    echo $popular ? '<span class = "popular">Популярное</span>' : '';

                    if(!$hot || !$popular)
                    {
                        echo '<br>';
                    }

                    if(isset($tema_tours))
                    {
                        foreach($tema_tours as $key => $value)
                        {
                            if ($key == 2)
                            {
                                echo '<br>';
                            }
                            echo ' <span> '. $value .' </span>&nbsp';
                        }
                    }
?>
                </div>
                <div class="price">
<?php
                    preg_match_all("/([0-9]*).([0-9]*)$/", $price, $_price);

                    echo '<span class = "int-price-prod">'.Yii::app()->format->formatNumber($price_int).$ico.'</span>';

                    if(isset($_price[1][0], $_price[2][0]))
                    {
                        echo '<span>'.Yii::app()->format->formatNumber($_price[1][0]).'</span>.'. substr($_price[2][0], 0, 2) .' руб.';
                    }
?>
                </div>
                <h3><?php echo $country ;?> <img class="flag-country" src = "/<?php echo $flag ;?>" alt = ""><span class="tyr-title"> <?php echo $product->title ;?> </span></h3>
                <div id="country-info">
                    <div class="col-xs-2 no-left">
                        <p>Вылет из: <span><?php echo $vylet ;?></span></p>
                    </div>
                    <div class="col-xs-2">
                        <p><span><?php echo $dlitelnost ;?></span></p>
                    </div>
                    <div class="col-xs-2">
                        <p>Транспорт: <span><?php echo $transport ;?></span></p>
                    </div>
                    <div class="col-xs-2">
                        <p>Питание: <span><?php echo $pitanie ;?></span></p>
                    </div>
                    <div class="col-xs-2">
                        <p><span><?php echo $sostav ;?></span></p>
                    </div>
                    <div class="col-xs-2 no-right ">
                        <a href = ""><?php echo Yii::t('app', 'Book a tour') ;?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div id="main-content">
    <div class="container" id="tyr-content">
        <div class="row">
            <ul class="nav nav-tabs country-tabs">
                <li class="active"><a href="#description" data-toggle="tab">Описание</a><span></span></li>
                <li><a href="#reviews" data-toggle="tab">Отзывы</a><span></span></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <div class="col-xs-3 no-left">
<?php
                        echo
                        '<div id="recently" style="margin-bottom: 3px;">
                            <h2>Наш офис</h2>
                            <div class="address">
                                ' . $this->settings['address'] . '
                            </div>
                            <div class="work">
                                ' . $this->settings['work'] . '
                            </div>
                            <div class="phone">
                                ' . $this->mts[1][0] . ' <span> ' . $this->mts[2][0] . '</span></span> <br>
                                ' . $this->velcom[1][0] . ' <span> ' . $this->velcom[2][0] . '</span></span>
                            </div>
                            <div class="mail">
                                ' . $this->settings['email_order'] . '
                            </div>
                        </div>';

                        $session = Yii::app()->session;
                        $session->open();

                        $cookies = Yii::app()->getRequest()->getCookies();

                        $cookie = $cookies->itemAt('PHPSESSID');

                        if ($cookie != FALSE)
                        {
                            $cookie->expire = time() + 3600 * 24 * 7;

                            $cookies->add('PHPSESSID', $cookie);
                        }

                        $viewed = '';

                        if($session['viewed'])
                        {
                            echo
                            '<div id="recently">
                            <h2>Недавно просмотренные</h2>';

                            foreach($session['viewed'] as $val)
                            {
                                $value = CatalogProducts::model()->active()->findByPk($val);

                                $sale_array = unserialize($value->sale_info);
                                $link = $value->getUrlForItem(1);
                                $stars = $value->getStars();

                                $image = $value->getOneFile('original');

                                $sostav = $value->getSostav();

                                $dlitelnost = $value->getDlitelnost();

                                $hot = $value->getIsHot() ? '<span class = "hot">Горящий тур</span>' : '';
                                $popular = '';

                                if(!$hot)
                                {
                                    $popular = $value->getIsPopular() ? '<span class = "popular">Популярное</span>' : '';
                                }

                                if(!$image)
                                {
                                    $image = Yii::app()->params['noimage'];
                                }

                                $sale = $sale_array[0] ? '<span class = "sale">'.$sale_array[0].'%</span>' : '';

                                echo
                                '<div class="item img-cont hot_tours_item">
                                    <a href="/'.$link.'">
                                        <img src = "/'.$image.'" alt = "">
                                        <h3>'.$value->title.'</h3>

                                        <div class = "stars">';

                                        for($i = 0; $i < 5; $i++)
                                        {
                                            if($i < $stars['value'])
                                            {
                                                echo '<img src = "/images/star_full.png" alt = "">';
                                            }
                                            elseif($i > 0)
                                            {
                                                echo '<img src = "/images/star.png" alt = "">';
                                            }
                                            else
                                            {
                                                break;
                                            }
                                        }

                                $ico = ($value->price)
                                    ? '<i class=" icon '.$this->currency_usd->currencyName->icon.'"></i>'
                                    : '<i class=" icon '.$this->currency_eur->currencyName->icon.'"></i>';
                                $price = ($value->price) ? $value->price * $this->currency_byn->course : $value->price_eur * $this->currency_byn->course * $this->currency_eur->course;
                                $price_int = ($value->price) ? $value->price : $value->price_eur;

                                echo
                                        '</div>
                                        <h5>От <span>'.number_format($price, 2, ".", " ").' руб.</span></h5>
                                        <span class = "int-price">'.Yii::app()->format->formatNumber($price_int).$ico.'</span>
                                        '.$hot.$popular.'
                                        '.$sale.'
                                        <div class="footer-container">
                                            <span>'.$sostav['value'].'</span>
                                            <span>'.$dlitelnost['value'].'</span>
                                        </div>
                                    </a>
                                </div>';
                            }
                            echo
                            '</div>';
                        }

                        $tema_categories = CatalogProducts::model()->active()->findAllByAttributes(array('parent_id' => Yii::app()->params['tema_catalog']));

                        if($tema_categories)
                        {
                            echo
                            '<div id="recently-tours">
                                <h2>Тематические туры</h2>';
                                foreach($tema_categories as $key => $value)
                                {
                                    if($key > 5)
                                    {
                                        break;
                                    }
                                    echo '<a href = "/'.$this->getUrlById(Yii::app()->params['pages']['tema-tours']).'/#'.$value->name.'">' . $value->title . '</a>';
                                }
                            echo
                            '</div>
                            <div class="clearfix"></div>';
                        }
?>
                        [[w:NewsLastWidget|parent_id=2;count=3;]]
                    </div>
                    <div class="col-xs-9 no-right">
                        <h3 class="descr hotel_title descr-hotel">Отель</h3>
                        <div class="stars">
<?php
                            for($i = 0; $i < 5; $i++)
                            {
                                if($i < $stars['value'])
                                {
                                    echo '<img src = "/images/star_full.png" alt = ""> ';
                                }
                                elseif($i > 0)
                                {
                                    echo '<img src = "/images/star.png" alt = "">';
                                }
                                else
                                {
                                    break;
                                }
                            }

?>
                        </div>
                        <div class="clearfix"></div>
                        <h2 class="descr hotel-title no-left"><?php echo isset($name_hotel) ? $name_hotel : '' ;?></h2>

                        <div class="col-xs-7 no-left photo-tour">
                            <div id="big" class="big image-big">
<?php
                                $hotel_img = $product->getFiles();

                                $image_big = '';
                                $images_block = '';
                                $rel = '';

                                if($hotel_img)
                                {
                                    foreach($hotel_img as $image)
                                    {
                                        $path_small = '/'.$image['path'].'small/'.$image['name'];
                                        $path_big = '/'.$image['path'].'big/'.$image['name'];
//                                        $path_medium = '/'.$image['path'].'medium/'.$image['name'];

//                                        $main_img = $path_medium ? $path_medium : $path_big;

                                        if ($image_big == '')
                                        {
                                            $image_big .= '<a href="'.$path_big.'" rel="lightbox[group]"><img src="'.$path_big.'" class="img-responsive"/></a>' ;
                                        }
                                        else
                                        {
                                            $rel = 'lightbox[group]';
                                        }

                                        $images_block .= '<a href="'.$path_big.'" rel="'.$rel.'" class="prev_img" data-medium="'.$path_big.'" ><img src="'.$path_small.'"  class="img-responsive"/></a>' ;
                                    }
                                }
                                else
                                {
                                    $path_big = '/'.Yii::app()->params['noimage'];

                                    $image_big .= '<a href="'.$path_big.'" rel="lightbox[group]"><img src="'.$path_big.'" class="img-responsive"/></a>' ;
                                }

                                $cs = Yii::app()->getClientScript();
                                $cs->registerPackage('lightbox');

                                $prev_img = '
                                    $(".prev_img").click(function()
                                    {
                                        var medium=$(this).data("medium");
                                        var big = $(this).attr("href");
                                        $(".image-big a").attr("href",big).find("img").attr("src",medium);
                                        $(".prev_img").attr("rel","lightbox[group]");
                                        $(this).attr("rel","");

                                        return false;
                                    });
                                ';
                                $cs->registerScript('prev_img', $prev_img);
?>
                                <?php echo $image_big ;?>
                            </div>

                            <div id="small" class="small">
                                <?php echo $images_block ;?>
                            </div>
                        </div>
                        <div class="col-xs-5 no-right">
                            <div class="param">
<?php
                                if(isset($hotel))
                                {
                                    foreach($hotel as $value)
                                    {
                                        switch($value)
                                        {
                                            case Yii::app()->params['wi-fi']:
                                                echo '<span class="wi-fi" data-toggle="tooltip" title="Бесплатный wi-fi"></span>';
                                                break;
                                            case Yii::app()->params['transfer']:
                                                echo '<span class="transfer" data-toggle="tooltip" title="Трансфер"></span>';
                                                break;
                                            case Yii::app()->params['restoran']:
                                                echo '<span class="restouran" data-toggle="tooltip" title="Ресторан"></span>';
                                                break;
                                            case Yii::app()->params['sportzal']:
                                                echo ' <span class="sportzal" data-toggle="tooltip" title="Спорт зал"></span>';
                                                break;
                                        }
                                    }
                                }
?>
                            </div>
                            <div class="text">
                                <?php echo $product->preview ;?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="text" style="margin-top: 40px;">
                            <h2 class="descr descr-about">Подробности тура</h2>
                            <?php echo $product->text ;?>
                            <h2 class="descr descr-ok">Заказать тур</h2>
                        </div>
<?php
                        $model = new VizaForm();

                        $form = $this->beginWidget('BsActiveForm',
                            array(
                                'id' => 'zakaz-tyr',
                                'htmlOptions' => array(
                                    'role' => 'form',
                                    'class' => 'poland'
                                ),
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateOnChange' => true,
                                    'validateOnType' => false,
                                ),
                            )
                        );
?>
                        <?php echo $form->hiddenField($model, 'country', array('value' => $country)); ?>
                        <?php echo $form->hiddenField($model, 'hotel', array('value' => $name_hotel)); ?>

                        <div class = "form-group col-xs-4 no-left">
                            <?php echo $form->labelEx($model, 'name'); ?>
                            <?php echo $form->textField($model, 'name', array('placeholder' => 'Иванов Иван')); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>

                        <div class = "form-group col-xs-4">
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
                            echo $form->error($model, 'phone');
?>
                        </div>

                        <div class = "form-group col-xs-4 no-right">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>

                        <div class = "form-group col-xs-4 no-left">
<?php
                            echo $form->labelEx($model, 'date_to');

                            $this->widget('zii.widgets.jui.CJuiDatePicker',
                                array(
                                    'language' => 'ru',
                                    'model' => $model,
                                    'attribute' => 'date_to',
                                    'options' => array(
                                        'showAnim' => 'fold',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                        'value' => (!empty($model->date_to)) ? date("d.m.Y", $model->date_to) : '',
                                        'placeholder' => '01.01.2016'
                                    ),
                                )
                            );

                            echo $form->error($model, 'date_to');
?>
                        </div>

                        <div class = "form-group col-xs-4">
<?php
                            echo $form->labelEx($model, 'date_from');

                            $this->widget('zii.widgets.jui.CJuiDatePicker',
                                array(
                                    'language' => 'ru',
                                    'model' => $model,
                                    'attribute' => 'date_from',
                                    'options' => array(
                                        'showAnim' => 'fold',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                        'value' => (!empty($model->date_from)) ? date("d.m.Y", $model->date_from) : '',
                                        'placeholder' => '01.01.2016'
                                    ),
                                )
                            );

                            echo $form->error($model, 'date_from');
?>
                        </div>

                        <div class = "form-group col-xs-1">
                            <?php echo $form->labelEx($model, 'child'); ?>
                            <?php echo $form->dropDownList($model, 'child', array_combine(range(0, 12), range(0, 12))); ?>
                            <?php echo $form->error($model, 'child'); ?>
                        </div>

                        <div class = "form-group col-xs-1 no-right">
                            <?php echo $form->labelEx($model, 'man'); ?>
                            <?php echo $form->dropDownList($model, 'man', array_combine(range(1, 12), range(1, 12))); ?>
                            <?php echo $form->error($model, 'man'); ?>
                        </div>

                        <div class = "form-group">
                            <?php echo $form->labelEx($model, 'questions'); ?>
                            <?php echo $form->textarea($model, 'questions', array('placeholder' => 'Оставьте свое предложение..')); ?>
                            <?php echo $form->error($model, 'questions'); ?>
                        </div>
<?php
                        echo BsHtml::submitButton(Yii::t('app', 'Book a tour'), array('id' => 'viz_submit'));
                        $this->endWidget();
?>
                    </div>
                </div>
                <div class="tab-pane" id="reviews">
                    <div class="col-xs-3 no-left">
<?php
                        $form = $this->beginWidget('BsActiveForm',
                            array(
                                'id' => 'rewies-form',
                                'htmlOptions' => array(
                                    'role' => 'form',
                                    'class' => 'about',
                                ),
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                    'validateOnChange' => true,
                                    'validateOnType' => false,
                                ),
                            )
                        );
?>
                        <h2>Новый отзыв</h2>

                        <?php echo $form->hiddenField($reviews, 'product_id', array('value' => $product->id)) ;?>

                        <div class="form-group">
                            <?php echo $form->labelEx($reviews, 'fullname'); ?>
                            <?php echo $form->textField($reviews, 'fullname', array('placeholder' => 'Иванов Иван')); ?>
                            <?php echo $form->error($reviews,'fullname'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($reviews, 'email'); ?>
                            <?php echo $form->textField($reviews, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
                            <?php echo $form->error($reviews,'email'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->label($reviews, 'header'); ?>
                            <?php echo $form->textField($reviews, 'header', array('placeholder' => 'Заголовок отзыва')); ?>
                            <?php echo $form->error($reviews,'header'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($reviews, 'text', array('label' => 'Текст отзыва')); ?>
                            <?php echo $form->textArea($reviews, 'text', array('placeholder' => 'Напишите плюсы и минусы данного тура')); ?>
                            <?php echo $form->error($reviews, 'text'); ?>
                        </div>

                        <button type="submit">Отправить отзыв</button>
                        <?php $this->endWidget(); ?>
                    </div>

                    <div class="col-xs-9 no-right">
<?php
                        $this->widget('application.widgets.ProductListView',
                            array(
                                'id' => 'products-list',
                                'itemView' => '_one_review_view',
                                'dataProvider' => $reviews_item,
                                'ajaxUpdate' => false,
                                'template' => "{items}\n<div class=\"col-xs-12 no-all text-left\">{pager}</div>",
                                'pager' => array(
                                    'class' => 'bootstrap.widgets.BsPager',
                                    'firstPageLabel' => '',
                                    'prevPageLabel' => '',
                                    'nextPageLabel' => '',
                                    'lastPageLabel' => '',
                                    'hideFirstAndLast' => true,
                                )
                            )
                        );
?>
<!--                        <div class="item">-->
<!--                            <div class="date">01.05.2016</div>-->
<!--                            <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--                            <div class="text">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                                              Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О пределах добра и зла» средневековый книгопечатник вырвал отдельные фразы и слова, получив текст-«рыбу», широко используемый и по сей день. Конечно, возникают некоторые вопросы, связанные с использованием Lorem ipsum на сайтах и проектах, ориентированных на кириллический контент – написание символов на латыни и на кириллице значительно различается.</div>-->
<!--                            <div class="autor">Иванов Иван</div>-->
<!--                            <a href = "">Показать больше</a>-->
<!--                        </div>-->
<!---->
<!--                        <div class="answer">-->
<!--                            <div class="date">01.05.2016</div>-->
<!--                            <div class="text">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                                              Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще </div>-->
<!--                            <div class="autor">Иванов Иван</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="item">-->
<!--                            <div class="date">01.05.2016</div>-->
<!--                            <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--                            <div class="text">-->
<!--                                Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                            </div>-->
<!--                            <div class="autor">Иванов Иван</div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="item">-->
<!--                            <div class="date">01.05.2016</div>-->
<!--                            <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--                            <div class="text">-->
<!--                                Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                            </div>-->
<!--                            <div class="autor">Иванов Иван</div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        <div id="pagination-container">-->
<!--                            <ul>-->
<!--                                <li><a href = ""></a></li>-->
<!--                                <li><a href = "">1</a></li>-->
<!--                                <li><a href = "">2</a></li>-->
<!--                                <li><a href = "">3</a></li>-->
<!--                                <li><a href = "">...</a></li>-->
<!--                                <li><a href = "">8</a></li>-->
<!--                                <li><a href = ""></a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

    $(function()
    {
        $('[data-toggle="tooltip"]').tooltip({placement : 'bottom'});

        $("#country-info a").click(function()
        {
            $('.country-tabs a:first').tab('show')
            var destination = $('#viz_submit').offset().top;
            $('body, html').animate( { scrollTop: destination - 500 }, 1100 );
            return false;
        });
    });

</script>