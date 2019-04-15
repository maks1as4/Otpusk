<?php
/* @var $this SlidesController */
/* @var $model Slides */

$this->breadcrumbs=array(
	'Журнал слайдов'=>array('index'),
	'Просмотр слайда'=>array('view','id'=>$model->id),
	'Изменить слайд',
);

$this->menu=array(
	array('label'=>'Журнал слайдов', 'url'=>array('index')),
	array('label'=>'Создать слайд', 'url'=>array('create')),
	array('label'=>'Просмотр слайда', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить слайд #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>