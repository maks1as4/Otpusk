<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Журнал страниц'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
	array('label'=>'Создать страницу', 'url'=>array('choice')),
	array('label'=>'Изменить страницу', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Изменить тип страницы', 'url'=>array('changeType', 'id'=>$model->id)),
	array('label'=>'Удалить страницу', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверенны?'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);
?>

<h1>Просмотр страницы: <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_page_type',
		'name',
		'url',
		'content',
		'seo_title',
		'seo_decryption',
		'seo_keywords',
		'comments',
		'visibility',
		'adate',
		'udate',
	),
)); ?>
