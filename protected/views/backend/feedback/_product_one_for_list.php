<li class="one_item feedback" id="<?php echo $data->id;?>" style="border-color:<?php echo $data::getColorStatus($data->status); ?>">
    <div class="row">
        <div class="col-xs-1 text-center">
            <span class="number-answer"><?php echo $data->id; ?></span>
            <?php echo BsHtml::checkBox('checkbox['.$data->id.']',false,array('class'=>'checkbox group')); ?>
            <?php echo BsHtml::label('','checkbox_'.$data->id,false,array('class'=>'checkbox')); ?>
            <span class="date"><?php echo date("d.m.Y H:m", $data->time); ?></span>
        </div>
        <div class="col-xs-2 name">
            <?php foreach($data->feedbackAnswers as $key => $value){?>
                <div class="feedback_system">
                    <?php echo $value->settingsFeedback->name; ?>: 
                    <?php echo $value->value; ?>
                </div>
            <?php }?>
        </div>
        <div class="col-xs-2 tema">
            <?php echo BsHtml::link($data->tree->title,$this->createUrl('update').'?id='.$data->id); ?>
        </div>
        <div class="col-xs-6 name">
            <?php echo $data->ask; ?>
        </div>
    </div>
</li>