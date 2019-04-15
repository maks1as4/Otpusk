<?php

class OptionsController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index'),
				'roles'=>array(Users::ROLE_ADMIN),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$model = Options::model()->findByPk(1);

		if(isset($_POST['Options']))
		{
			$model->attributes=$_POST['Options'];
			if($model->save())
			{
				Yii::app()->user->setFlash('optionsSaved','Настройки сохранены.');
				$this->refresh();
			}
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
}