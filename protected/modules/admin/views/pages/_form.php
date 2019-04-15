<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательные для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

<?php if (!$model->isNewRecord){ ?>
	<div class="row space">
		<strong>Тип страницы:</strong>&nbsp;
		<span class="type-name"><?php echo $pageType->name; ?></span>&nbsp;
		<?php echo CHtml::link('изменить тип страницы',array('changeType','id'=>$model->id)); ?>
	</div>
<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
<?php if ($pageType->content_required=='1'){ ?>
		<?php echo $form->label($model,'content',array('label'=>'Контент <span class="required">*</span>')); ?>
<?php }else{ ?>
		<?php echo $form->labelEx($model,'content'); ?>
<?php } ?>
		<?php $this->widget('application.extensions.ckeditor.ECKEditor', array(
			'model'=>$model,
			'attribute'=>'content',
			'language'=>'ru',
			'editorTemplate'=>'control',
			'width'=>'835px',
			'height'=>'500px',
		)); ?>
		<?php echo $form->error($model,'content'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textField($model,'seo_keywords',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->dropDownList($model,'comments',array(1=>'включить',0=>'отключить')); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->dropDownList($model,'visibility',array(1=>'показывать',0=>'скрыть')); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

<?php if (!$model->isNewRecord && Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php echo $form->dropDownList($model,'id_user',Users::getList(true)); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->