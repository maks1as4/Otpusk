<?php
/* @var $this PagesImagesController */
/* @var $model PagesImages */

$this->breadcrumbs=array(
	'Журнал картинок'=>array('index'),
	'Добавить картинку',
);

$this->menu=array(
	array('label'=>'Журнал картинок', 'url'=>array('index')),
);
?>

<h1>Добавить картинку</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>