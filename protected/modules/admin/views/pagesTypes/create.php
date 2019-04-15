<?php
/* @var $this PagesTypesController */
/* @var $model PagesTypes */

$this->breadcrumbs=array(
	'Типы страниц'=>array('index'),
	'Создать новый тип',
);

$this->menu=array(
	array('label'=>'Типы страниц', 'url'=>array('index')),
);
?>

<h1>Создать новый тип страницы</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>