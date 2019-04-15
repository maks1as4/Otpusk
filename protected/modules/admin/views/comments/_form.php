<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_page'); ?>
		<?php echo $form->dropDownList($model,'id_page',Pages::getList()); ?>
		<?php echo $form->error($model,'id_page'); ?>
	</div>
<?php } ?>

<?php if (!$model->isNewRecord && Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->dropDownList($model,'id_user',Users::getList(true)); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'guest'); ?>
		<?php echo $form->textField($model,'guest',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'guest'); ?>
	</div>
<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Comments::getAllStatus()); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->