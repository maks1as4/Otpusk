<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибуты'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Изменить атрибуту',
);

$this->menu=array(
	array('label'=>'Атрибуты', 'url'=>array('index')),
	array('label'=>'Создать новую атрибуту', 'url'=>array('create')),
	array('label'=>'Просмотр атрибуты', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить атрибуту #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>