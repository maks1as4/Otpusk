<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Журнал комментариев'=>array('index'),
	'Комментарий #'.$model->id=>array('view','id'=>$model->id),
	'Изменить комментарий #'.$model->id,
);

$this->menu=array(
	array('label'=>'Журнал комментариев', 'url'=>array('index')),
	array('label'=>'Создать комментарий', 'url'=>array('create')),
	array('label'=>'Просмотр комментария', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить комментарий #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>