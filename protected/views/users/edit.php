<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->cssCode = '
table.avatar {
	margin:10px 0;
}
table.avatar td {
	vertical-align:middle;
}
';
$this->pageTitle = 'Изменить данные пользователя';
/*$this->breadcrumbs = array(
	'Изменить данные пользователя',
);*/
?>

<h1>Изменить данные пользователя</h1>

<?php if(Yii::app()->user->hasFlash('edit')){ ?>

<div class="alert alert-success">
	<?php echo Yii::app()->user->getFlash('edit'); ?>
</div>

<?php } ?>

<?php if(Yii::app()->user->hasFlash('deleteAvatar')){ ?>

<div class="alert alert-success">
	<?php echo Yii::app()->user->getFlash('deleteAvatar'); ?>
</div>

<?php } ?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-edit-form',
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
	'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'round'),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row row-mb20">
		<?php echo $form->label($model,'username'); ?>
		<?php echo CHtml::encode($model->username); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'edit w250','maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
<?php if (!$model->isNewRecord && $model->avatar!=''){ ?>
		<table class="avatar">
			<tr>
				<td>
					<div class="avatar-round" style="background:url('/storage/images/avatars/<?php echo CHtml::encode($model->avatar); ?>') no-repeat 0 0;"></div>
				</td>
				<td>
					<?php echo CHtml::link('удалить аватар',array('deleteAvatar'),array('confirm'=>'Вы уверены?')); ?>
				</td>
			</tr>
		</table>
<?php } ?>
		<?php echo $form->fileField($model,'avatar',array('class'=>'file','maxlength'=>50)); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->