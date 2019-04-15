<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Журнал комментариев',
);

$this->menu=array(
	array('label'=>'Создать комментарий', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comments-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал комментариев</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<br /><br />

<?php echo CHtml::form(); ?>
выделенное: 
<?php echo CHtml::submitButton('активировать',array('name'=>'active')); ?>
<?php echo CHtml::submitButton('скрыть',array('name'=>'hide')); ?>
<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
<?php echo CHtml::submitButton('удалить',array('name'=>'delete')); ?>
<?php } ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comments-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'commentId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
		),
		'comment'=>array(
			'name'=>'comment',
			'value'=>'Functions::getSubText($data->comment,40,true)',
			'filter'=>false,
		),
		'id_page'=>array(
			'name'=>'id_page',
			'value'=>'Functions::getSubText($data->page->name,40,true)',
			'filter'=>Pages::getStrictList(),
		),
		'id_user'=>array(
			'name'=>'id_user',
			'value'=>'($data->id_user != 0) ? $data->user->username : "-"',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>Users::getStrictList(true),
		),
		'status'=>array(
			'name'=>'status',
			'value'=>'Comments::getStatus($data->status)',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>Comments::getAllStatus(),
		),
		'adate'=>array(
			'name'=>'adate',
			'header'=>'Дата',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'delete'=>array(
					'visible'=>'Yii::app()->user->checkAccess(Users::ROLE_ADMIN)',
				),
			),
		),
	),
)); ?>

<?php echo CHtml::endForm(); ?>