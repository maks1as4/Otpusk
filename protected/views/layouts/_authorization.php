<?php
$authorization = new LoginForm;
if (!Yii::app()->user->isGuest)
{
	$user = Users::model()->findByPk(Yii::app()->user->id);
	$avatar_src = ($user->avatar != '') ? '/storage/images/avatars/'.CHtml::encode($user->avatar) : '/images/noavatar.jpg';
}
?>
<?php if (Yii::app()->user->isGuest){ ?>
<div class="authorization item">
	<div class="authorization-inner shadow">
		<h3>Вход на сайт</h3>
		<?php echo CHtml::form(array('users/login'),'post',array('class'=>'round authorization')); ?>
		<label for="username">
			Имя пользователя 
			<span class="req" title="Это поле обязательно для заполнения.">*</span>
		</label>
		<?php echo CHtml::activeTextField($authorization, 'username',array('class'=>'edit')); ?>
		<label for="password">
			Пароль 
			<span class="req" title="Это поле обязательно для заполнения.">*</span>
		</label>
		<?php echo CHtml::activePasswordField($authorization, 'password',array('class'=>'edit')); ?>
		<?php echo CHtml::activeCheckBox($authorization,'rememberMe',array('checked'=>1)); ?>
		<label for="rememberMe" class="remember-me">
			Запомнить меня
		</label>
		<div class="links">
			<?php echo CHtml::link('Регистрация',array('users/registration')); ?>
			<!--a href="/">Забыли пароль?</a-->
		</div>
		<?php echo CHtml::submitButton('Вход',array('class'=>'button')); ?>
		<?php echo CHtml::endForm(); ?>
	</div>
</div><!-- /authorization -->
<?php }else{ ?>
<div class="user-panel shadow item">
	<h3>Пользователь</h3>
	<table>
		<tr>
			<td>
				<div class="avatar-round" style="background:url('<?php echo $avatar_src; ?>') no-repeat 0 0;"></div>
			</td>
			<td>
				<?php echo CHtml::encode($user->username); ?><br />
<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN) || Yii::app()->user->checkAccess(Users::ROLE_MODER)){ ?>
				<?php echo CHtml::link('панель управления',array('/admin')); ?><br />
<?php } ?>
				<?php echo CHtml::link('настройки профиля',array('users/edit')); ?><br />
				<?php echo CHtml::link('выход',array('users/logout')); ?>
			</td>
		</tr>
	</table>
</div><!-- /user-panel -->
<?php } ?>