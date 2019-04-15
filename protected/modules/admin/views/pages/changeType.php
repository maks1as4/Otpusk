<?php
$this->breadcrumbs=array(
	'Журнал страниц'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Изменить страницу'=>array('update', 'id'=>$model->id),
	'Изменить тип страницы',
);

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
	array('label'=>'Создать страницу', 'url'=>array('choice')),
	array('label'=>'Просмотр страницы', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Изменить тип страницы: <?php echo $model->name; ?></h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form-type',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_page_type'); ?>
		<?php echo $form->dropDownList($model,'id_page_type',PagesTypes::getList()); ?>
		<?php echo $form->error($model,'id_page_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->