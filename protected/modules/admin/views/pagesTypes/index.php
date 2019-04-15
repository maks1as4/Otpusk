<?php
/* @var $this PagesTypesController */
/* @var $model PagesTypes */

$this->breadcrumbs=array(
	'Типы страниц',
);

$this->menu=array(
	array('label'=>'Создать новый тип', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-types-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Типы страниц</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-types-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
		),
		'name'=>array(
			'name'=>'name',
			'header'=>'Наименование типа',
		),
		'type'=>array(
			'name'=>'type',
			'header'=>'Наименование (англ.)',
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
