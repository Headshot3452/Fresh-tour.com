    <div class="item dl-lists">
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('city_id'); ?></dt>
                <dd><?php echo CHtml::encode($data->city->title); ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('street'); ?></dt>
                <dd><?php echo CHtml::encode($data->street); ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('house'); ?></dt>
                <dd><?php echo CHtml::encode($data->house); ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('apartment'); ?></dt>
                <dd><?php echo CHtml::encode($data->apartment); ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('user_name'); ?></dt>
                <dd><?php echo CHtml::encode($data->user_name); ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <dt><?php echo $data->getAttributeLabel('phone'); ?></dt>
                <dd><?php echo CHtml::encode($data->phone); ?></dd>
            </dl>
    </div>