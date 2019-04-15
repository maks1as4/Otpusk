<?php
/* @var $this AttributesTypesController */
/* @var $model AttributesTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'attributes-types-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row sep">
		<?php echo $form->labelEx($model,'id_page_type'); ?>
		<?php echo $form->dropDownList($model,'id_page_type',PagesTypes::getList()); ?>
		<?php echo $form->error($model,'id_page_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translit'); ?>
		<?php echo $form->textField($model,'translit',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'translit'); ?>
	</div>

	<div class="row sep">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>100,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',AttributesTypes::getAllTypes()); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->