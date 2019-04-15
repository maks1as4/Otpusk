<?php

class UsersController extends Controller
{
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xefeadb,
				'maxLength'=>5,
				'minLength'=>3,
				'foreColor'=>0x6f0025,
			),
		);
	}

	public function actionLogin()
	{
		if (Yii::app()->user->isGuest)
		{
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
			// display the login form
			$this->render('login',array('model'=>$model));
		}
		else $this->redirect(Yii::app()->homeUrl);
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegistration()
	{
		$model = new Users('registration');

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			$username = $model->username;
			$password = $model->password;
			if($model->save())
			{
				if ($model->status=='0')
				{
					$login = new LoginForm;
					$login->username = $username;
					$login->password = $password;
					$login->rememberMe = true;
					if ($login->validate() && $login->login())
						$this->redirect(Yii::app()->homeUrl);
				}
				else
				{
					Yii::app()->user->setFlash('registrationCheck','Поздравляем! Вы успешно зарегистрировались на сайте, но зайти под своим пользователем вы сможете только после поверки данных пользователя модератором.');
					$this->refresh();
				}
			}
		}

		$this->render('registration',array(
			'model'=>$model,
		));
	}

	public function actionView($username)
	{
		$model = Users::model()->find('username=:login',array(':login'=>$username));
		if($model===null)
			throw new CHttpException(404);

		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionEdit()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$model->setScenario('user-edit');

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
			{
				Yii::app()->user->setFlash('edit','Ваши данные были изменены.');
				$this->refresh();
			}
		}

		$this->render('edit',array(
			'model'=>$model,
		));
	}

	public function actionDeleteAvatar()
	{
		$model=$this->loadModel(Yii::app()->user->id);
		$avatarPath = Yii::getPathOfAlias(Users::IMAGES_DIR).DIRECTORY_SEPARATOR.$model->avatar;
		if (is_file($avatarPath))
		{
			chmod(Yii::getPathOfAlias(Users::IMAGES_DIR).DIRECTORY_SEPARATOR,0777); // открываем папку для записи
			unlink($avatarPath);
			chmod(Yii::getPathOfAlias(Users::IMAGES_DIR).DIRECTORY_SEPARATOR,0555); // закрываем папку от записи
		}
		$model->avatar = '';
		if ($model->save(false))
			Yii::app()->user->setFlash('deleteAvatar','Аватар был успешно удален.');
		$this->redirect(array('edit'));
	}

	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404);
		return $model;
	}
}