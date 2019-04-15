<?php
/* @var $this AttributesTypesController */
/* @var $model AttributesTypes */

$this->breadcrumbs=array(
	'Типы атрибутов'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить тип',
);

$this->menu=array(
	array('label'=>'Типы атрибутов', 'url'=>array('index')),
	array('label'=>'Создать новый тип', 'url'=>array('create')),
	array('label'=>'Просмотр типа', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить тип атрибута: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>