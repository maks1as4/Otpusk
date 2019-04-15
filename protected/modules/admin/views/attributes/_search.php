<?php
/* @var $this AttributesController */
/* @var $model Attributes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_page'); ?>
		<?php echo $form->dropDownList($model,'id_page',Pages::getStrictList(),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_attribute_type'); ?>
		<?php echo $form->dropDownList($model,'id_attribute_type',AttributesTypes::getStrictList(),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>3072)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->