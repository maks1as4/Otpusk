<?php
/* @var $this PagesTypesController */
/* @var $model PagesTypes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-types-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row sep">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>100,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textField($model,'seo_title',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seo_decryption'); ?>
		<?php echo $form->textField($model,'seo_decryption',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'seo_decryption'); ?>
	</div>

	<div class="row sep">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textField($model,'seo_keywords',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<h3>Картинки</h3>

	<div class="row">
		<label>Mini</label>
		<?php echo $form->dropDownList($model,'img_mini_t',PagesImages::getImagesTypes()); ?>&nbsp;&nbsp;
		<?php echo $form->textField($model,'img_mini_w',array('size'=>5,'maxlength'=>4)); ?> x 
		<?php echo $form->textField($model,'img_mini_h',array('size'=>5,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'img_mini_w'); ?>
		<?php echo $form->error($model,'img_mini_h'); ?>
	</div>

	<div class="row">
		<label>Small</label>
		<?php echo $form->dropDownList($model,'img_small_t',PagesImages::getImagesTypes()); ?>&nbsp;&nbsp;
		<?php echo $form->textField($model,'img_small_w',array('size'=>5,'maxlength'=>4)); ?> x 
		<?php echo $form->textField($model,'img_small_h',array('size'=>5,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'img_small_w'); ?>
		<?php echo $form->error($model,'img_small_h'); ?>
	</div>

	<div class="row">
		<label>Medium</label>
		<?php echo $form->dropDownList($model,'img_medium_t',PagesImages::getImagesTypes()); ?>&nbsp;&nbsp;
		<?php echo $form->textField($model,'img_medium_w',array('size'=>5,'maxlength'=>4)); ?> x 
		<?php echo $form->textField($model,'img_medium_h',array('size'=>5,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'img_medium_w'); ?>
		<?php echo $form->error($model,'img_medium_h'); ?>
	</div>

	<div class="row">
		<label>Big</label>
		<?php echo $form->dropDownList($model,'img_big_t',PagesImages::getImagesTypes()); ?>&nbsp;&nbsp;
		<?php echo $form->textField($model,'img_big_w',array('size'=>5,'maxlength'=>4)); ?> x 
		<?php echo $form->textField($model,'img_big_h',array('size'=>5,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'img_big_w'); ?>
		<?php echo $form->error($model,'img_big_h'); ?>
	</div>

	<div class="row">
		<label>Large</label>
		<?php echo $form->dropDownList($model,'img_large_t',PagesImages::getImagesTypes()); ?>&nbsp;&nbsp;
		<?php echo $form->textField($model,'img_large_w',array('size'=>5,'maxlength'=>4)); ?> x 
		<?php echo $form->textField($model,'img_large_h',array('size'=>5,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'img_large_w'); ?>
		<?php echo $form->error($model,'img_large_h'); ?>
	</div>

	<div class="row sep">
		<?php echo $form->labelEx($model,'img_bg_color'); ?>
		<?php echo $form->textField($model,'img_bg_color',array('size'=>38,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'img_bg_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content_required'); ?>
		<?php echo $form->dropDownList($model,'content_required',array(1=>'обязательно',0=>'не обязательно')); ?>
		<?php echo $form->error($model,'content_required'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->dropDownList($model,'comments',array(1=>'включить',0=>'отключить')); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pager'); ?>
		<?php echo $form->textField($model,'pager',array('size'=>10,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'pager'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->