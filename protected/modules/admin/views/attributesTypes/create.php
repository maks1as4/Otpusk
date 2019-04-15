<?php
/* @var $this AttributesTypesController */
/* @var $model AttributesTypes */

$this->breadcrumbs=array(
	'Типы атрибутов'=>array('index'),
	'Создать новый тип',
);

$this->menu=array(
	array('label'=>'Типы атрибутов', 'url'=>array('index')),
);
?>

<h1>Создать новый тип атрибута</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>