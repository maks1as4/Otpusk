<?php
/* @var $this PagesTypesController */
/* @var $model PagesTypes */

$this->breadcrumbs=array(
	'Типы страниц'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Типы страниц', 'url'=>array('index')),
	array('label'=>'Создать новый тип', 'url'=>array('create')),
	array('label'=>'Изменить тип', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить тип', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);
?>

<h1>Просмотр типа: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'name',
		'description',
		'comments',
	),
)); ?>
