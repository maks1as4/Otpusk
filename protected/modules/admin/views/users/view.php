<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Журнал пользователей'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Журнал пользователей', 'url'=>array('index')),
	array('label'=>'Создать пользователя', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
	array('label'=>'Обновить пользователя', 'url'=>array('update', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
	array('label'=>'Изменить пароль', 'url'=>array('password','id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
	array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);
?>

<h1>Просмотр пользователя <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'avatar',
		'role',
		'status',
		'adate',
	),
)); ?>
