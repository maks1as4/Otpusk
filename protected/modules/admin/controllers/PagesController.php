<?php

class PagesController extends Controller
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
				'actions'=>array('index', 'view', 'choice', 'create', 'update', 'changeType'),
				'roles'=>array(Users::ROLE_MODER, Users::ROLE_ADMIN),
			),
			array('allow',
				'actions'=>array('delete'),
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
		$model=new Pages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pages']))
			$model->attributes=$_GET['Pages'];

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

	public function actionChoice()
	{
		$this->render('choice',array(
			'models'=>PagesTypes::model()->findAll(array('order'=>'name')),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($type)
	{
		if (!isset($type) || empty($type))
			throw new CHttpException(404,'The requested page does not exist.');

		$pageType = PagesTypes::model()->find('type=:pt',array(':pt'=>$type));
		if ($pageType===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$model=new Pages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			$model->id_page_type=$pageType->id;
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
			'pageType'=>$pageType,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if (!isset($id) || empty($id))
			throw new CHttpException(404,'The requested page does not exist.');

		$model=$this->loadModel($id);

		$pageType = PagesTypes::model()->findByPk($model->id_page_type);
		if ($pageType===null)
			throw new CHttpException(404,'The requested page does not exist.');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			$model->id_page_type=$pageType->id;
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
			'pageType'=>$pageType,
		));
	}

	public function actionChangeType($id)
	{
		if (!isset($id) || empty($id))
			throw new CHttpException(404,'The requested page does not exist.');

		$model=$this->loadModel($id);

		if(isset($_POST['Pages']))
		{
			$model->id_page_type=$_POST['Pages']['id_page_type'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->render('changeType',array(
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
