<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->showSideAuth=false;
$this->pageTitle='Вход на сайт';
/*$this->breadcrumbs=array(
	'Вход на сайт',
);*/
?>

<h1>Вход на сайт</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions'=>array('class'=>'round'),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'edit w250')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'edit w250','maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe',array('checked'=>1)); ?>
		<?php echo $form->label($model,'rememberMe',array('style'=>'display:inline; padding-left:5px;')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Вход',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
