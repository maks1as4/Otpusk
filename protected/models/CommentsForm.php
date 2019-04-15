<?php

class CommentsForm extends CFormModel
{
	public $id_user;
	public $guest;
	public $comment;
	public $verifyCode;

	public function rules()
	{
		$options = array(
			'Core.Encoding'=>'utf-8',
			'HTML.Allowed'=>'p,strong,b,em,i,a,del',
			'AutoFormat.AutoParagraph'=>true,
			'AutoFormat.DisplayLinkURI'=>true,
			'AutoFormat.RemoveEmpty'=>true,
		);
		$htmlpurifier = new CHtmlPurifier();
		$htmlpurifier->options = $options;

		return array(
			array('comment', 'required'),
			array('comment', 'filter', 'filter'=>array($htmlpurifier, 'purify')),
			array('comment', 'length', 'max'=>30000),
			array('id_user', 'length', 'max'=>11),
			array('guest', 'length', 'max'=>255),
			array('guest', 'match', 'pattern'=>'/^([a-zа-яё0-9\s-_.]+)$/ui', 'message'=>'Недопустимые символы, разрешено a-z а-я 0-9 -_ .'),
			// is Guest
			array('guest', 'required', 'on'=>'isGuest'),
			array('verifyCode', 'required', 'on'=>'isGuest'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'isGuest'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'guest' => 'Ваше имя',
			'comment' => 'Коментарий',
			'verifyCode' => 'Код проверки',
		);
	}

	public function beforeValidate()
	{
		$this->id_user = (!Yii::app()->user->isGuest) ? Yii::app()->user->id : 0;
		if (!Yii::app()->user->isGuest) $this->guest = '';
		return parent::beforeValidate();
	}
}