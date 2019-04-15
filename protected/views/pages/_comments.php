<a id="comments-top"></a>
<div id="comments-header">
	<h2>Комментарии</h2>

<?php if(Yii::app()->user->hasFlash('comentAdded')){ ?>

	<div class="alert alert-success">
		<?php echo Yii::app()->user->getFlash('comentAdded'); ?>
	</div>

<?php } ?>

<?php if(Yii::app()->user->hasFlash('comentCheck')){ ?>

	<div class="alert alert-info">
		<?php echo Yii::app()->user->getFlash('comentCheck'); ?>
	</div>

<?php } ?>

	<span class="badge badge-dark-blue"><?php echo count($comments); ?></span>&nbsp;
	<?php echo (count($comments) == 1) ? 'комментарий' : 'комментариев'; ?>&nbsp;&nbsp;
	<?php echo (!empty($comments) && $page->comments == '1') ? CHtml::link('добавить комментарий',array('view','type'=>$page->pageType->type,'id'=>$page->id,'url'=>$page->url,'#'=>'add-comment-top'),array('rel'=>'nofollow')) : ''; ?>
</div><!-- /comments-header -->

<?php if (!empty($comments)){ ?>
<div id="comments">
<?php foreach ($comments as $comment){ ?>
<?php
$setClasses = '';
if (isset($comment->user) && !empty($comment->user))
{
	$setClasses .= ($comment->user->role == Users::ROLE_MODER) ? ' comment_'.Users::ROLE_MODER : '';
	$setClasses .= ($comment->user->role == Users::ROLE_ADMIN) ? ' comment_'.Users::ROLE_ADMIN : '';
	$setClasses .= ($comment->user->role == Users::ROLE_USER) ? ' comment_'.Users::ROLE_USER : '';
	$setClasses .= ($comment->user->id == Yii::app()->user->id) ? ' comment_author' : '';
}
else
{
	$setClasses .= ' comment_guest';
}
?>
	<div class="comment clearfix<?php echo $setClasses; ?>">
		<div class="comment-picture">
<?php if ($comment->id_user != '0' && isset($comment->user->avatar) && !empty($comment->user->avatar)){ ?>
			<div class="avatar-round" style="background:url('/storage/images/avatars/<?php echo CHtml::encode($comment->user->avatar); ?>') no-repeat 0 0;"></div>
<?php }else{ ?>
			<div class="avatar-round" style="background:url('/images/noavatar.jpg') no-repeat 0 0;"></div>
<?php } ?>
		</div>
		<div class="comment-wrap clearfix">
			<div class="submitted">
				<div class="comment-author">
<?php if ($comment->id_user != '0'){ ?>
					<?php echo CHtml::link(CHtml::encode($comment->user->username),array('users/view','username'=>$comment->user->username),array('class'=>'username','target'=>'_blank')); ?>
<?php }else{ ?>
					<?php echo CHtml::encode($comment->guest); ?>
<?php } ?>
				</div>
				<div class="comment-created">
					<?php echo Functions::getDateCP($comment->adate); ?> в <?php echo Functions::getTimeCP($comment->adate); ?>
				</div>
			</div>
			<div class="content">
				<?php echo $comment->comment; ?>
			</div>
		</div>
	</div>
<?php } ?>
</div><!-- /comments -->
<?php } ?>

<?php if ($options->add_comments_user == '1'){ ?>

<?php if ($options->add_comments_guest=='0' && Yii::app()->user->isGuest){ ?>
<p>Чтобы оставлять комментарии <?php echo CHtml::link('авторизируйтесь',array('users/login')); ?> или <?php echo CHtml::link('зарегистрируйтесь',array('users/registration')); ?>.</p>
<?php }else{ ?>
<?php if ($page->comments == '1'){ ?>
<a id="add-comment-top"></a>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comments-add-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'validateOnType'=>false,
		'validateOnChange'=>true,
	),
	'htmlOptions'=>array('class'=>'round'),
)); ?>

<?php if (Yii::app()->user->isGuest){ ?>
	<div class="row">
		<?php echo $form->labelEx($commentForm,'guest'); ?>
		<?php echo $form->textField($commentForm,'guest',array('size'=>60,'maxlength'=>255, 'class'=>'edit w250')); ?>
		<?php echo $form->error($commentForm,'guest'); ?>
	</div>
<?php }else{ ?>
	<div class="row row-mb20">
		<?php echo $form->label($commentForm,'guest'); ?>
		<?php echo CHtml::link(CHtml::encode(Yii::app()->user->username),array('users/edit'),array('class'=>'name-for-comment','target'=>'_blank')); ?>
	</div>
<?php }?>
	<div class="row">
		<?php echo $form->labelEx($commentForm,'comment'); ?>
		<?php $this->widget('application.extensions.ckeditor.ECKEditor', array(
			'model'=>$commentForm,
			'attribute'=>'comment',
			'language'=>'ru',
			'editorTemplate'=>'comments',
			'width'=>'778px',
			'height'=>'200px',
		)); ?>
		<?php echo $form->error($commentForm,'comment'); ?>
	</div>

<?php if(CCaptcha::checkRequirements() && Yii::app()->user->isGuest){ ?>
	<div class="row">
		<?php echo $form->labelEx($commentForm,'verifyCode'); ?>
		<div>
			<?php $this->widget('CCaptcha'); ?><br />
			<?php echo $form->textField($commentForm,'verifyCode',array('class'=>'edit w250')); ?>
		</div>
		<?php echo $form->error($commentForm,'verifyCode'); ?>
		<div class="hint">
			Пожалуйста, введите символы, изображенные на картинке.<br />
			Символы не чувствительны к регистру.
		</div>
	</div>
<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить',array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php }else{ ?>
	<p>Комментарии отключены.</p>
<?php } ?>
<?php } ?>

<?php } ?>