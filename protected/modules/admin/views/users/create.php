<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Журнал пользователей'=>array('index'),
	'Создать пользователя',
);

$this->menu=array(
	array('label'=>'Журнал пользователей', 'url'=>array('index')),
);
?>

<h1>Создать пользователя</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>