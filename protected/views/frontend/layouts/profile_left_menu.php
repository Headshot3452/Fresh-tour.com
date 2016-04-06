<?php
    $this->renderPartial('//layouts/_header',array());

    $this->renderFile(Yii::getPathOfAlias('application.views').'/_all_alerts.php',array());

    if (!empty($this->breadcrumbs))
    {
        echo '<div>';

            $this->widget('bootstrap.widgets.BsBreadcrumb',array(
                'links'=>$this->breadcrumbs,
            ));

        echo '</div>';
    }
?>
    <div class="container">
        <div id="profil">
            <div class="row">
                <div class="col-xs-3">
                    <h3 class="lk_title">Личный кабинет</h3>
<?php
                        $menu = $this->getLeftMenu();

                        if(isset($menu[0]))
                        {
                            echo '<ul class="profil_left_menu">';

                            foreach($menu as $value)
                            {
                                echo '<li>'.$value["text"];
                                if(isset($value["children"]))
                                {
                                    echo '<ul id="settings_submenu" class="collapse in">';

                                    foreach($value["children"] as $item)
                                    {
                                        echo '<li>'.$item["text"].'</li>';
                                    }

                                    echo '</ul>';
                                }
                                echo '</li>';
                            }

                            echo '</ul>';
                        }
?>
                </div>

                <div class="col-xs-9">
                    <?php echo $content ;?>
                </div>

            </div>
        </div>
    </div>
</div>

<footer>
</footer>
</body>
</html>
