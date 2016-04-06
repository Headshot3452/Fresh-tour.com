<?php
$cs=Yii::app()->getClientScript();
$cs->registerPackage('owlcarousel');

$carousel='

var owl = $("#'.$this->id.'").owlCarousel({
items : '.$this->count_items.',
autoPlay : true,
stopOnHover : true,
navigation : false,
});
$(".next").click(function(){
owl.trigger("owl.next");
return false;
});

$(".prev").click(function(){
owl.trigger("owl.prev");
return false;
});
';

$cs->registerScript("carousel-".$this->id,$carousel);

echo '<div class="catalog-carousel">';
    echo '<div class="title-block">
        <div class="title">'.$this->title.'</div>
        <div class="buttons">
            <a href="#" class="prev"><span class="fa fa-angle-left"></span></a>
            <a href="#" class="next"><span class="fa fa-angle-right"></span></a>
        </div>
    </div>';

    echo '<div>';
        echo '<div class="owl-container">';
            echo '<div id="'.$this->id.'" class="owlCarousel">';
                foreach($this->_data as $item)
                {
                    $image=$item->getOneFile('small');
                    if ($image=='')
                    {
                    $image= Yii::app()->params['noimage'];
                    }
                    $url=$this->controller->createUrl('catalog/tree',array('url'=>$item->getUrlForItem($item->parent->root)));
                    echo '<div class="carousel-block catalog-product text-center">
                        <div class="image">
                            <a href="'.$url.'"><img class="img-responsive" src="/'.$image.'"></a>
                        </div>
                        <div class="description-block">
                            <div class="title">
                                <a href="'.$url.'">'.$item->title.'</a>
                            </div>
                            <div class="price text-shadow">
                                '.number_format($item->price,0,'.',' ').' <span> руб.</span>
                            </div>
                        </div>
                        <div class="in-cart">
                            <span class="title">В КОРЗИНУ</span>
                            <span class="icon icon-site-cart"></span>
                        </div>
                    </div>';
                }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '<div class="clearfix"></div>';
    echo '</div>';