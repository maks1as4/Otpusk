<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<?php if(Yii::app()->user->hasFlash('deleteAvatar')){ ?>
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('deleteAvatar'); ?>
</div>
<?php } ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

<?php if ($model->isNewRecord){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
<?php }else{ ?>
	<p><?php echo CHtml::link('изменить пароль',array('password','id'=>$model->id)); ?></p>
<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
<?php if (!$model->isNewRecord && $model->avatar!=''){ ?>
		<div>
			<?php echo CHtml::image('/storage/images/avatars/'.CHtml::encode($model->avatar)); ?>
<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
			<?php echo CHtml::link('удалить аватар',array('deleteAvatar','id'=>$model->id),array('confirm'=>'Вы уверены?')); ?>
<?php } ?>
		</div>
<?php } ?>
		<?php echo $form->fileField($model,'avatar',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',Users::getAllRoles()); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

<?php if (!$model->isNewRecord){ ?>
	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',array(0=>'активен',1=>'бан')); ?>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->