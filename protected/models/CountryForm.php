<?php
    class CountryForm extends CFormModel
    {
        public $date_from;
        public $tema_tours;
        public $price_tours;
        public $stars;
        public $type_hotel;

        public function rules()
        {
            return array(
                array('date_from, tema_tours, price_tours, stars, type_hotel', 'safe'),
            );
        }

        public function attributeLabels()
        {
            return array(
                'date_from' => Yii::t('app', 'Departure date'),
                'tema_tours' => Yii::t('app', 'Theme tour'),
                'price_tours' => Yii::t('app', 'Tour cost'),
                'stars' => Yii::t('app', 'Star rating'),
                'type_hotel' => Yii::t('app', 'Hotel type'),
            );
        }

        public function getTemaTours()
        {
            $temaTours = CatalogParamsVal::model()->findAll('params_id = :id', array(':id' => Yii::app()->params['tema_tours']));
            return CHtml::listData($temaTours, 'value', 'value');
        }

        public function getTypeHotel()
        {
            $typeHotel = CatalogParamsVal::model()->findAll('params_id = :id', array(':id' => Yii::app()->params['type_hotel']));
            return CHtml::listData($typeHotel, 'value', 'value');
        }
    }