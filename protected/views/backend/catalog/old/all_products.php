<?php
    $this->renderPartial('index',
        array(
            'model' => $model, 'count' => $count
        )
    );