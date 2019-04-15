<?php
/* @var $this AttributesController */
/* @var $model Attributes */

$this->breadcrumbs=array(
	'Атрибуты',
);

$this->menu=array(
	array('label'=>'Создать новую атрибуту', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#attributes-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Атрибуты</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attributes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
			'name'=>'id',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
		),
		'id_page'=>array(
			'name'=>'id_page',
			'value'=>'$data->page->name',
			'filter'=>Pages::getStrictList(),
		),
		'id_attribute_type'=>array(
			'name'=>'id_attribute_type',
			'value'=>'$data->attributeType->name',
			'filter'=>AttributesTypes::getStrictList(),
		),
		'value',
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
