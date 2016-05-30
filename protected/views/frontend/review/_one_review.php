<div class="item">
    <div class="date"><?php echo date('d.m.Y', $data->create_time) ;?></div>
    <div class="title"><?php echo CHtml::encode($data->header) ;?></div>
    <div class="text"><?php echo $data->text ;?></div>
    <div class="autor"><?php echo CHtml::encode($data->fullname) ;?></div>
    <a href = "">Показать больше</a>
</div>
<div class="clearfix"></div>

<?php
    if($data->note)
    {
        echo
        '<div class="answer">
            <div class="text">'.$data->note.'</div>
            <div class="autor" style="margin-top: 0;">Администратор</div>
        </div>';
    }