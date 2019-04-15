<?php
/* @var $this SlidesController */
/* @var $model Slides */

$this->breadcrumbs=array(
	'Журнал слайдов',
);

$this->menu=array(
	array('label'=>'Создать слайд', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#slides-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал слайдов</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'slides-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sort_order'=>array(
			'name'=>'sort_order',
			'header'=>'№',
			'headerHtmlOptions'=>array('width'=>'50'),
			'htmlOptions'=>array('style'=>'text-align:right'),
			'filter'=>false,
		),
		array(
			'header'=>'Слайд',
			'value'=>'(is_file(Yii::getPathOfAlias(Slides::IMAGES_DIR).DIRECTORY_SEPARATOR.$data->image."_thumb.".$data->ext)) ? CHtml::link(CHtml::image(Yii::app()->getBaseUrl(true)."/storage/images/slides/".$data->image."_thumb.".$data->ext,null),array("update","id"=>$data->id)) : ""',
			'headerHtmlOptions'=>array('width'=>'200'),
			'htmlOptions'=>array('style'=>'text-align:center'),
			'type'=>'raw',
		),
		'visibility'=>array(
			'name'=>'visibility',
			'value'=>'$data->visibility == 1 ? "видимый" : "скрытый"',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'filter'=>array(1=>'видимые',0=>'скрытые'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
