<?php
/* @var $this PagesImagesController */
/* @var $model PagesImages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-images-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполненения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_page'); ?>
		<?php echo $form->dropDownList($model,'id_page',Pages::getList()); ?>
		<?php echo $form->error($model,'id_page'); ?>
	</div>

	<div class="row">
<?php if ($model->isNewRecord){ ?>
		<label>Картинка <span class="required">*</span></label>
<?php }else{ ?>
		<label>Картинка</label>
		<?php if ($model->image!='' && $model->ext!='') echo CHtml::link(CHtml::image('/storage/images/pages/'.$model->image.'_thumb.'.$model->ext,null,array('style'=>'margin:5px 0;')),'/storage/images/pages/'.$model->image.'.'.$model->ext,array('target'=>'_blank')); ?><br />
<?php } ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alt'); ?>
		<?php echo $form->textField($model,'alt',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->