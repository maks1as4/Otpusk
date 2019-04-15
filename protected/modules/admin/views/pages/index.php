<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Журнал страниц',
);

$this->menu=array(
	array('label'=>'Создать страницу', 'url'=>array('choice')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал страниц</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
		),
		'name',
		'id_page_type'=>array(
			'name'=>'id_page_type',
			'value'=>'$data->pageType->name',
			'filter'=>PagesTypes::getStrictList(),
		),
		'id_user'=>array(
			'name'=>'id_user',
			'value'=>'($data->id_user != 0) ? $data->user->username : "нет"',
			'filter'=>Users::getStrictList(true),
		),
		'visibility'=>array(
			'name'=>'visibility',
			'value'=>'$data->visibility == 1 ? "видимая" : "скрытая"',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>array(1=>'видимые',0=>'скрытые'),
		),
		'udate'=>array(
			'name'=>'udate',
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
