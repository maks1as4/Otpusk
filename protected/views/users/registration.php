<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->showSideAuth = false;
$this->pageTitle = 'Регистрация нового пользователя';
/*$this->breadcrumbs = array(
	'Регистрация',
);*/
?>
<h1>Регистрация</h1>

<?php if(Yii::app()->user->hasFlash('registrationCheck')){ ?>

	<div class="alert alert-info">
		<?php echo Yii::app()->user->getFlash('registrationCheck'); ?>
	</div>

<?php } ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
	'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'round'),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'edit w250','maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'edit w250','maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2',array('class'=>'edit w250','maxlength'=>20)); ?>
		<?php echo $form->error($model,'password2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'edit w250','maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->fileField($model,'avatar',array('class'=>'file','maxlength'=>50)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

<?php if(CCaptcha::checkRequirements()){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
			<?php $this->widget('CCaptcha'); ?><br />
			<?php echo $form->textField($model,'verifyCode',array('class'=>'edit w250')); ?>
		</div>
		<div class="hint">
			Пожалуйста, введите символы, изображенные на картинке.<br />
			Символы не чувствительны к регистру.
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Регистрация',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->