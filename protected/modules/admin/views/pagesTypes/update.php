<?php
/* @var $this PagesTypesController */
/* @var $model PagesTypes */

$this->breadcrumbs=array(
	'Типы страниц'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить тип',
);

$this->menu=array(
	array('label'=>'Типы страниц', 'url'=>array('index')),
	array('label'=>'Создать новый тип', 'url'=>array('create')),
	array('label'=>'Просмотр типа', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить тип: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>