<?php
	class BronForm extends CFormModel
	{
		public $name;
		public $phone;
		public $email;
		public $questions;
		public $country;

		public function rules()
		{
			return array(
				array('name, phone, email, country', 'required'),
				array('name, email, phone', 'filter', 'filter'=>'trim'),
				array('email', 'email'),
				array('questions', 'safe'),
				array('phone', 'match', 'pattern' => Yii::app()->params['phone']['regexp']),
			);
		}

		public function attributeLabels()
		{
			return array(
				'name' => Yii::t('app', 'Your name'),
				'phone' => Yii::t('app', 'Phone'),
				'email' => Yii::t('app', 'Your e-mail'),
				'country' => Yii::t('app', 'Country'),
				'questions' => Yii::t('app', 'Comment'),
			);
		}
	}