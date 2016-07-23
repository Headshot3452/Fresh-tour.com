<?php
    if($this->page_id == Yii::app()->params['pages']['poisk_tours'] || $this->page_id == Yii::app()->params['pages']['aviabilety'])
    {
        echo
        '<div id = "title-container">
            <img src = "/images/title-img.png" alt = "Слайд">
            <div class = "breadcrumbs-container">
                <div class = "container">
                    <div class = "row">
                        <div class = "breadcrumbs">';
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
        echo
                        '</div>
                        <h3>'.$this->pageTitle.'</h3>
                    </div>
                </div>
                <div class = "clearfix"></div>
            </div>
        </div>
        <div class="container" style="margin-top: 30px; margin-bottom: 30px;">
            <div class="row">
                '.$this->text.'
            </div>
        </div>';
    }
    else
    {
?>
        <div class="text">
            <?php echo $this->text ;?>
        </div>
<?php
    }
?>