<?php

class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $body;
	public $verifyCode;

	public function rules()
	{
		return array(
			array('name, email, body, verifyCode', 'required'),
			array('email', 'email'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	public function attributeLabels()
	{
		return array(
			'name' => 'Ваше имя',
			'email' => 'Ваш E-mail',
			'body' => 'Сообщение',
			'verifyCode' => 'Код проверки',
		);
	}
}
