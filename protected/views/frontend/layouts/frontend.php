<?php
    $this->renderPartial('//layouts/_header',array());

    $this->renderFile(Yii::getPathOfAlias('application.views').'/_all_alerts.php',array());

    echo $content;
?>

<?php
    $this->renderPartial('//layouts/_footer',array());
?>