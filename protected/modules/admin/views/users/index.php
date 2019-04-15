<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Журнал пользователей',
);

$this->menu=array(
	array('label'=>'Создать пользователя', 'url'=>array('create'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

$userNameValue = (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)) ? 'CHtml::link($data->username,array("update","id"=>$data->id))' : '$data->username';
?>

<h1>Журнал пользователей</h1>

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
<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
<?php echo CHtml::submitButton('заблокировать',array('name'=>'ban')); ?>
<?php } ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'selectableRows'=>2,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'userId',
		),
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
		),
		'username'=>array(
			'name'=>'username',
			'type'=>'raw',
			'value'=>$userNameValue,
		),
		'email',
		'role'=>array(
			'name'=>'role',
			'headerHtmlOptions'=>array('width'=>'70'),
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>Users::getAllRoles(),
		),
		'status'=>array(
			'name'=>'status',
			'value'=>'Users::getStatus($data->status)',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>Users::getAllStatus(),
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
				'update'=>array(
					'visible'=>'Yii::app()->user->checkAccess(Users::ROLE_ADMIN)',
				),
				'delete'=>array(
					'visible'=>'Yii::app()->user->checkAccess(Users::ROLE_ADMIN)',
				),
			),
		),
	),
)); ?>

<?php echo CHtml::endForm(); ?>