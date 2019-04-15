<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Журнал страниц'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить страницу',
);

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
	array('label'=>'Создать страницу', 'url'=>array('choice')),
	array('label'=>'Просмотр страницы', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить страницу: <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'pageType'=>$pageType)); ?>