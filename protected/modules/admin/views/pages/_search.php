<?php
/* @var $this PagesController */
/* @var $model Pages */
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
		<?php echo $form->label($model,'id_page_type'); ?>
		<?php echo $form->dropDownList($model,'id_page_type',PagesTypes::getStrictList(),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->dropDownList($model,'id_user',Users::getStrictList(true),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments'); ?>
		<?php echo $form->dropDownList($model,'comments',array(1=>'включены',0=>'отключены'),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visibility'); ?>
		<?php echo $form->dropDownList($model,'visibility',array(1=>'видимые',0=>'скрытые'),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'adate'); ?>
		<?php echo $form->textField($model,'adate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'udate'); ?>
		<?php echo $form->textField($model,'udate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->