<?php
$cs=Yii::app()->getClientScript();

$carousel='$("#'.$this->id.'").carousel();';
$cs->registerScript('carousel-'.$this->id,$carousel);

echo '<div id="'.$this->id.'" class="carousel slide" data-ride="carousel">';
echo '<!-- Wrapper for slides -->
                    <div class="carousel-inner">';
$active='active';
foreach($this->_items as $item)
{
    $image=$item->getOneFile($this->size);

    if (!empty($image))
    {
        echo '<div class="item '.$active.'" style="'.$this->height.'">
                            <img src="/'.$image.'">
                            <div class="block-description carousel-caption clear-carousel-caption">
                                <div class="description pull-left">
                                '.$item->description.'
                                </div>
                                <div class="arrow-block pull-left">
                                </div>
                                <div class="arrow pull-left">
                                </div>
                            </div>
                    </div>';
        $active='';
    }
    else
    {
        $count--;
    }
}
echo '</div>';

echo '<ol class="carousel-indicators">';
$active='class="active"';
for ($i=0;$i<$count;$i++)
{
    echo '<li data-target="#'.$this->id.'" data-slide-to="'.$i.'" '.$active.'></li>';
    $active='';
}
echo'</ol>';
echo '<!-- Controls -->
                                  <a class="left carousel-control" href="#'.$this->id.'" role="button" data-slide="prev">
                                    <span class=""></span>
                                  </a>
                                  <a class="right carousel-control" href="#'.$this->id.'" role="button" data-slide="next">
                                    <span class=""></span>
                                  </a>';
echo '</div>';