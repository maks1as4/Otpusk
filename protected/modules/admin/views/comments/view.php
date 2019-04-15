<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Журнал комментариев'=>array('index'),
	'Просмотр комментария #'.$model->id,
);

$this->menu=array(
	array('label'=>'Журнал комментариев', 'url'=>array('index')),
	array('label'=>'Создать комментарий', 'url'=>array('create')),
	array('label'=>'Изменить комментарий', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить комментарий', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);
?>

<h1>Просмотр комментария #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_page',
		'id_user',
		'guest',
		'comment',
		'status',
		'adate',
		'udate',
	),
)); ?>
