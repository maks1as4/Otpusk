<?php
/* @var $this SlidesController */
/* @var $model Slides */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slides-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
<?php if ($model->isNewRecord){ ?>
		<label>Слайд (780x300) <span class="required">*</span></label>
<?php }else{ ?>
		<label>Слайд (780x300)</label>
		<?php if ($model->image!='' && $model->ext!='') echo CHtml::link(CHtml::image('/storage/images/slides/'.$model->image.'_thumb.'.$model->ext,null,array('style'=>'margin:5px 0;')),'/storage/images/slides/'.$model->image.'.'.$model->ext,array('target'=>'_blank')); ?><br />
<?php } ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>100,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>100,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>100,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->dropDownList($model,'color',Slides::getBgColors()); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->dropDownList($model,'visibility',array(0=>'скрыть',1=>'показывать')); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order',array('size'=>10,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->