<?php
/* @var $this SlidesController */
/* @var $model Slides */

$this->breadcrumbs=array(
	'Журнал слайдов'=>array('index'),
	'Просмотр слайда',
);

$this->menu=array(
	array('label'=>'Журнал слайдов', 'url'=>array('index')),
	array('label'=>'Создать слайд', 'url'=>array('create')),
	array('label'=>'Изменить слайд', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить слайд', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),
);
?>

<h1>Просмотр слайда #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'ext',
		'name',
		'content',
		'link',
		'color',
		'visibility',
	),
)); ?>
