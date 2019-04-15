<?php
/* @var $this PagesImagesController */
/* @var $model PagesImages */

$this->breadcrumbs=array(
	'Журнал картинок',
);

$this->menu=array(
	array('label'=>'Добавить картинку', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-images-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Журнал картинок</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-images-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header'=>'Картинка',
			'value'=>'(is_file(Yii::getPathOfAlias(PagesImages::IMAGES_DIR).DIRECTORY_SEPARATOR.$data->image."_thumb.".$data->ext)) ? CHtml::link(CHtml::image(Yii::app()->getBaseUrl(true)."/storage/images/pages/".$data->image."_thumb.".$data->ext,$data->alt),array("update","id"=>$data->id)) : ""',
			'htmlOptions'=>array('style'=>'text-align:center'),
			'type'=>'raw',
		),
		'id_page'=>array(
			'name'=>'id_page',
			'value'=>'Functions::getSubText($data->page->name,80,true)',
			'filter'=>Pages::getStrictList(),
			'type'=>'raw',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
