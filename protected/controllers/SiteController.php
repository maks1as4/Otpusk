<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xefeadb,
				'maxLength'=>5,
				'minLength'=>3,
				'foreColor'=>0x6f0025,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/title';
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;

		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/

		if (isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if($model->validate())
			{
				include_once('protected/extensions/mailer/class-mailer.php');
				$mail = new Mailer();
				$mail->From = iconv('utf-8','cp1251',$model->email);
				$mail->FromName = iconv('utf-8','cp1251',$model->name);
				$mail->Subject = iconv('utf-8','cp1251','Письмо с сайта otpusk-ekb.ru, страница Контакты');
				$body  = iconv('utf-8','cp1251','Письмо с сайта otpusk-ekb.ru, страница Контакты')."\n\n";
				$body .= iconv('utf-8','cp1251',$model->body)."\n\n";
				$body .= iconv('utf-8','cp1251','Отправитель: '.$model->name)."\n";
				$body .= iconv('utf-8','cp1251','Контактный e-mail: '.$model->email)."\n";
				$body .= iconv('utf-8','cp1251','Время отправления: '.date('Y-m-d H:i:s'))."\n";
				$mail->Body = $body;
				$mail->AddAddress(Yii::app()->params->infoEmail);
				if ($mail->Send())
					Yii::app()->user->setFlash('mailSend','Письмо отправлено. Спасибо, что написали нам, мы ответим Вам в ближайшее время.');
				else
					Yii::app()->user->setFlash('mailError','Произошла ошибка при отправке письма, повторите попытку.');
				$this->redirect(array('contact','#'=>'contact-form-top'));
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Тема номера
	 */
	public function actionTopic($id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'id=:pid and id_page_type=4 and visibility=1';
		$criteria->params = array(':pid'=>$id);
		$journal = Pages::model()->find($criteria);
		if ($journal === null)
			throw new CHttpException(404);

		$attr = array();
		$model = Attributes::model()->findAll('id_page=:pid',array(':pid'=>$journal->id));
		if (!empty($model))
		{
			foreach ($model as $m)
			{
				$attr[$m->attributeType->translit] = array(
					'name'=>$m->attributeType->name,
					'value'=>$m->value,
					'type'=>$m->attributeType->type,
				);
			}
		}

		if (!empty($attr) && isset($attr['journal_topic_id']) && !empty($attr['journal_topic_id']['value']))
		{
			$this->render('topic',array(
				'journal'=>$journal,
				'attributes'=>$attr,
			));
		}
		else
			throw new CHttpException(404);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}