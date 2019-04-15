<?php
/* @var $this SlidesController */
/* @var $model Slides */

$this->breadcrumbs=array(
	'Журнал слайдов'=>array('index'),
	'Создать слайд',
);

$this->menu=array(
	array('label'=>'Журнал слайдов', 'url'=>array('index')),
);
?>

<h1>Создать новый слайд</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>