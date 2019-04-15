<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->pageTitle='Наши контакты';
/*$this->breadcrumbs=array(
	'Контакты',
);*/
?>

<h1>Контакты</h1>

<div id="contacts">
	<ul>
		<li><i class="icon-home"></i>&nbsp;адрес: г. Екатеринбург ул. Бажова, 51 оф. 49</li>
		<li><i class="icon-phone"></i>&nbsp;телефон.факс: (343) 27-00-127, 27-00-227</li>
		<li><i class="icon-envelope"></i>&nbsp;почта: info@otpusk-ekb.ru</li>
		<li><i class="icon-globe"></i>&nbsp;сайт: otpusk-ekb.ru</li>
	</ul>
	<br />
	<h3>Найти нас на карте Яндекс</h3>
	<div>
		<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=uOfAqep1F9dcAOLMahHk024SQfrrxG7E&width=780&height=450"></script>
	</div>
</div>

<a id="contact-form-top"></a>
<h3>Отправить нам сообщение</h3>

<?php if(Yii::app()->user->hasFlash('mailSend')){ ?>

<div class="alert alert-success">
	<?php echo Yii::app()->user->getFlash('mailSend'); ?>
</div>

<?php } ?>

<?php if(Yii::app()->user->hasFlash('mailError')){ ?>

<div class="alert alert-error">
	<?php echo Yii::app()->user->getFlash('mailError'); ?>
</div>

<?php } ?>

<p>Если у Вас возникли вопросы или предложения, отправьте нам письмо. Спасибо.</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnType'=>false,
		'validateOnChange'=>true,
	),
	'htmlOptions'=>array('class'=>'round'),
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'edit w250')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'edit w250')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('class'=>'memo')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

<?php if(CCaptcha::checkRequirements()){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
			<?php $this->widget('CCaptcha'); ?><br />
			<?php echo $form->textField($model,'verifyCode',array('class'=>'edit w250')); ?>
			<?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<div class="hint">
			Пожалуйста, введите символы, изображенные на картинке.<br />
			Символы не чувствительны к регистру.
		</div>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->