<?php
$this->breadcrumbs=array(
	'Настройки',
);
?>

<?php if(Yii::app()->user->hasFlash('optionsSaved')){ ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('optionsSaved'); ?>
</div>

<?php } ?>

<h1>Настройки сайта</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'options-form',
)); ?>

	<div class="row">
		<?php echo $form->checkBox($model,'add_comments_guest'); ?>
		<?php echo $form->label($model,'add_comments_guest'); ?>
		<?php echo $form->error($model,'add_comments_guest'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model,'add_comments_user'); ?>
		<?php echo $form->label($model,'add_comments_user'); ?>
		<?php echo $form->error($model,'add_comments_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model,'check_comments_guest'); ?>
		<?php echo $form->label($model,'check_comments_guest'); ?>
		<?php echo $form->error($model,'check_comments_guest'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model,'check_comments_user'); ?>
		<?php echo $form->label($model,'check_comments_user'); ?>
		<?php echo $form->error($model,'check_comments_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($model,'check_user_registration'); ?>
		<?php echo $form->label($model,'check_user_registration'); ?>
		<?php echo $form->error($model,'check_user_registration'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->