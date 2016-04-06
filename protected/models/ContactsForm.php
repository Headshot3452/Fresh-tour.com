<?php
class ContactsForm extends CFormModel
{
    public $name;
    public $phone;
    public $email;
    public $subject;
    public $message;

    public function rules()
    {
        return array(
            array('name, email, phone, subject, message', 'filter', 'filter'=>'trim'),
            array('name, phone', 'required','on'=>'phone'),
            array('name, email, subject, message', 'required','on'=>'contacts'),
            array('email', 'email'),
            array('phone', 'match', 'pattern'=>Yii::app()->params['phone']['regexp']),
        );
    }

    public function attributeLabels()
    {
        return array(
            'name'=>Yii::t('app','Your name'),
            'phone'=>Yii::t('app','Phone'),
            'email'=>Yii::t('app','Your e-mail'),
            'subject'=>Yii::t('app','Subject'),
            'message'=>Yii::t('app','Message'),
        );
    }
}