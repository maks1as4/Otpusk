<?php
/* @var $this AttributesTypesController */
/* @var $model AttributesTypes */

$this->breadcrumbs=array(
	'Типы атрибутов'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Типы атрибутов', 'url'=>array('index')),
	array('label'=>'Создать новый тип', 'url'=>array('create')),
	array('label'=>'Изменить тип', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить тип', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),
);
?>

<h1>Просмотр типа атрибута: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_page_type',
		'name',
		'description',
		'type',
	),
)); ?>
