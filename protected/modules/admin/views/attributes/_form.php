<?php
/* @var $this AttributesController */
/* @var $model Attributes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attributes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_page'); ?>
		<?php echo $form->dropDownList($model,'id_page',Pages::getList()); ?>
		<?php echo $form->error($model,'id_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_attribute_type'); ?>
		<?php echo $form->dropDownList($model,'id_attribute_type',AttributesTypes::getList()); ?>
		<?php echo $form->error($model,'id_attribute_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>60,'maxlength'=>3072)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->