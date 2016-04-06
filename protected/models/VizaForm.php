<?php
	class VizaForm extends CFormModel
	{
		public $name;
		public $phone;
		public $email;
		public $date_to;
		public $date_from;
		public $man;
		public $child;
		public $questions;

		public function rules()
		{
			return array(
				array('name, phone, date_to, date_from, man, child', 'required'),
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
				'date_to' => Yii::t('app', 'Date to'),
				'date_from' => Yii::t('app', 'Date from'),
				'child' => Yii::t('app', 'Сhild'),
				'man' => Yii::t('app', 'Man'),
				'questions' => Yii::t('app', 'Questions'),
			);
		}
	}