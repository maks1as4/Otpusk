<?php
/* @var $this CommentsController */
/* @var $model Comments */
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
		<?php echo $form->dropDownList($model,'id_page',Pages::getList(),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_user'); ?>
		<?php echo $form->dropDownList($model,'id_user',Users::getStrictList(true),array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'guest'); ?>
		<?php echo $form->textField($model,'guest',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Comments::getAllStatus(),array('empty'=>'')); ?>
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