<?php

class UsersController extends Controller
{
	public $layout='/layouts/column2';

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
				'actions'=>array('index', 'view'),
				'roles'=>array(Users::ROLE_MODER, Users::ROLE_ADMIN),
			),
			array('allow',
				'actions'=>array('create', 'update', 'delete', 'password', 'deleteAvatar'),
				'roles'=>array(Users::ROLE_ADMIN),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		if (isset($_POST['active']) && !empty($_POST['userId']))
			Users::model()->updateByPk($_POST['userId'],array('status'=>0));

		if (isset($_POST['ban']) && !empty($_POST['userId']) && Yii::app()->user->checkAccess(Users::ROLE_ADMIN))
			Users::model()->updateByPk($_POST['userId'],array('status'=>1),array('condition'=>'role<>"'.Users::ROLE_ADMIN.'"'));

		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			// запоминаем текущую роль
			$oldRole = $model->role;
			$model->attributes=$_POST['Users'];
			// нельзя менять роль и статус у админов
			if ($oldRole == Users::ROLE_ADMIN)
			{
				$model->role = Users::ROLE_ADMIN;
				$model->status = 0;
			}
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model=$this->loadModel($id);
		// админов удалять нельзя
		if ($model->role != Users::ROLE_ADMIN)
			$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function actionPassword($id)
	{
		$model=$this->loadModel($id);
		$model->setScenario('password');
		if(isset($_POST['Users']))
		{
			$model->password=$_POST['Users']['password'];
			if($model->save())
				$this->redirect(array('index'));
		}
		$this->render('password',array(
			'model'=>$model,
		));
	}

	public function actionDeleteAvatar($id)
	{
		$model=$this->loadModel($id);
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
		$this->redirect(array('update','id'=>$id));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
