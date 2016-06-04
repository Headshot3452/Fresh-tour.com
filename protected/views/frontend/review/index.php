<div class="about" id="reviews">
    <h1>Отзывы о компании</h1>
<?php
    $this->widget('bootstrap.widgets.BsListView',
        array(
            'dataProvider' => $data,
            'itemView' => '_one_review',
            'ajaxUpdate' => false,
            'template' => '{items}<div class="clearfix"></div><div class="col-xs-6">{pager}</div>',
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
<!--    <div class="item">-->
<!--        <div class="date">01.05.2016</div>-->
<!--        <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--        <div class="text">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                          Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О пределах добра и зла» средневековый книгопечатник вырвал отдельные фразы и слова, получив текст-«рыбу», широко используемый и по сей день. Конечно, возникают некоторые вопросы, связанные с использованием Lorem ipsum на сайтах и проектах, ориентированных на кириллический контент – написание символов на латыни и на кириллице значительно различается.</div>-->
<!--        <div class="autor">Иванов Иван</div>-->
<!--        <a href = "">Показать больше</a>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--    <div class="answer">-->
<!--        <div class="date">01.05.2016</div>-->
<!--        <div class="text">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--                          Самым известным «рыбным» текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще</div>-->
<!--        <div class="autor">Иванов Иван</div>-->
<!--    </div>-->

<!--    <div class="item">-->
<!--        <div class="date">01.05.2016</div>-->
<!--        <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--        <div class="text">Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.</div>-->
<!--        <div class="autor">Иванов Иван</div>-->
<!--    </div>-->
<!---->
<!--    <div class="item">-->
<!--        <div class="date">01.05.2016</div>-->
<!--        <div class="title">ПР65 Rogner Bad Blumau. Суточные цены. </div>-->
<!--        <div class="text">-->
<!--            Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более того, нечитабельность текста сыграет на руку при оценке качества восприятия макета.-->
<!--        </div>-->
<!--        <div class="autor">Иванов Иван</div>-->
<!--    </div>-->

<!--    <div id="pagination-container">-->
<!--        <ul>-->
<!--            <li><a href = ""></a></li>-->
<!--            <li><a href = "">1</a></li>-->
<!--            <li><a href = "">2</a></li>-->
<!--            <li><a href = "">3</a></li>-->
<!--            <li><a href = "">...</a></li>-->
<!--            <li><a href = "">8</a></li>-->
<!--            <li><a href = ""></a></li>-->
<!--        </ul>-->
<!--    </div>-->

<?php
    $form = $this->beginWidget('BsActiveForm',
        array(
            'id' => 'rewies-form',
            'htmlOptions' => array(
                'role' => 'form',
                'class' => 'about',
            ),
            'enableAjaxValidation' => false,
            'action' => $this->createUrl('review/index'),
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

    <div class="form-group">
        <div class="col-xs-4 no-left">
            <?php echo $form->labelEx($model, 'fullname'); ?>
            <?php echo $form->textField($model, 'fullname', array('placeholder' => 'Иванов Иван')); ?>
            <?php echo $form->error($model,'fullname'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('placeholder' => 'ivanov@gmail.com')); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-4 no-right">
            <?php echo $form->label($model, 'header'); ?>
            <?php echo $form->textField($model, 'header', array('placeholder' => 'Заголовок отзыва')); ?>
            <?php echo $form->error($model,'header'); ?>
        </div>
    </div>
    <div class="clearfix offset" style="margin-bottom: 30px;"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'text', array('label' => 'Текст отзыва')); ?>
        <?php echo $form->textArea($model, 'text', array('placeholder' => 'Ваш отзыв')); ?>
        <?php echo $form->error($model, 'text'); ?>
    </div>

    <div class="form-group">
        <button type="submit">Отправить отзыв</button>
    </div>
<!--    <span>Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и </span>-->

    <?php $this->endWidget(); ?>
</div>

<script>
    $(function()
    {
        $(".item .text").each(function()
        {
            var autoHeight = $(this).closest('.item').find('.text').css({'max-height': 'none'}).height();
            $(this).closest('.item').find('.text').css({"max-height": 118});

            if(autoHeight <= 119)
            {
                $(this).siblings('a').hide();
            }
        });

        $('.item a').on('click', function(e)
        {
            if($(this).text() == 'Показать больше')
            {
                var autoHeight = $(this).closest('.item').find('.text').css({'max-height': 'none'}).height();
                $(this).closest('.item').find('.text').css({"max-height": 118});
                $(this).closest('.item').find('.text').animate({ "max-height": parseInt(autoHeight) }, parseInt(500));
                $(this).text('Скрыть');
            }
            else
            {
                $(this).closest('.item').find('.text').animate({ "max-height": 118 }, parseInt(500));
                $(this).text('Показать больше');
            }

            return false;
        });
    });
</script>