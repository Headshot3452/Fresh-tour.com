<?php
echo '<div id="'.$this->id.'" class="map" style="width:'.$this->width.';height:'.$this->height.'"></div>';

$cs=Yii::app()->getClientScript();
$cs->registerScriptFile('http://api-maps.yandex.ru/2.1/?lang='.Yii::app()->language);

$map_script='
            var map;

            ymaps.ready(function(){
                map = new ymaps.Map("'.$this->id.'", {
                    center: ['.$this->_data->getCenter().'],
                    zoom: '.$this->_data->getZoom().',
                    type: "'.$this->_data->getType().'",
                    controls: ["fullscreenControl","geolocationControl","zoomControl","typeSelector"],
                });
            });


            function createPlacemark(coords,iconContent,hintContent,balloonContent,preset)
            {
                var placemark = new ymaps.Placemark(coords,{
                    iconContent: iconContent,
                    hintContent: hintContent,
                    balloonContent: balloonContent,
                },
                {
                    preset: preset
                });

                return placemark;
            }
        ';

if (!empty($this->_data->mapsPlacemarks))
{
    $map_script.='ymaps.ready(function(){';
    foreach ($this->_data->mapsPlacemarks as $item)
    {
        $map_script.='
                        map.geoObjects.add(createPlacemark(['.$item->position.'],"'.$item->iconContent.'","'.$item->hintContent.'","'.$item->balloonContent.'","'.$item->preset.'"));
                ';
    }
    $map_script.='});';
}

$cs->registerScript('map_script',$map_script);