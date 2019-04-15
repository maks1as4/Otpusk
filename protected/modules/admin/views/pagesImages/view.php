<?php
/* @var $this PagesImagesController */
/* @var $model PagesImages */

$this->breadcrumbs=array(
	'Журнал картинок'=>array('index'),
	$model->image.'.'.$model->ext,
);

$this->menu=array(
	array('label'=>'Журнал картинок', 'url'=>array('index')),
	array('label'=>'Добавить картинку', 'url'=>array('create')),
	array('label'=>'Изменить картинку', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить картинку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?')),
);
?>

<h1>Просмотр картинки: <?php echo $model->image.'.'.$model->ext; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_page',
		'image',
		'ext',
		'alt',
	),
)); ?>
