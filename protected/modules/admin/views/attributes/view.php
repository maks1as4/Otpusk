<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибуты'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Атрибуты', 'url'=>array('index')),
	array('label'=>'Создать новую атрибуту', 'url'=>array('create')),
	array('label'=>'Изменить атрибуту', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить атрибуту', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);
?>

<h1>Просмотр атрибуты #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_attribute_type',
		'id_page',
		'value',
	),
)); ?>
