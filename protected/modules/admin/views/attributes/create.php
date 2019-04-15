<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибуты'=>array('index'),
	'Создать новую атрибуту',
);

$this->menu=array(
	array('label'=>'Атрибуты', 'url'=>array('index')),
);
?>

<h1>Создать новую атрибуту</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>