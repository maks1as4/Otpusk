<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Журнал комментариев'=>array('index'),
	'Создать комментарий',
);

$this->menu=array(
	array('label'=>'Журнал комментариев', 'url'=>array('index')),
);
?>

<h1>Создать комментарий</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>