<?php
/* @var $this PagesImagesController */
/* @var $model PagesImages */

$this->breadcrumbs=array(
	'Журнал картинок'=>array('index'),
	$model->image.'.'.$model->ext=>array('view','id'=>$model->id),
	'Изменить картинку',
);

$this->menu=array(
	array('label'=>'Журнал картинок', 'url'=>array('index')),
	array('label'=>'Добавить картинку', 'url'=>array('create')),
	array('label'=>'Просмотр картинки', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить картинку: <?php echo $model->image.'.'.$model->ext; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>