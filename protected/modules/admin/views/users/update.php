<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Журнал пользователей'=>array('index'),
	$model->username=>array('view','id'=>$model->id),
	'Обновить пользователя',
);

$this->menu=array(
	array('label'=>'Журнал пользователей', 'url'=>array('index')),
	array('label'=>'Создать пользователя', 'url'=>array('create')),
	array('label'=>'Просмотр пользователя', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Изменить пароль', 'url'=>array('password','id'=>$model->id)),
);
?>

<h1>Обновить пользователя <?php echo $model->username; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>