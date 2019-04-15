<?php
$this->pageTitle = 'Данные пользователя '.CHtml::encode($model->username);
/*$this->breadcrumbs = array(
	'Данные пользователя «'.CHtml::encode($model->username).'»',
);*/
$avatar_src = ($model->avatar != '') ? '/storage/images/avatars/'.CHtml::encode($model->avatar) : '/images/noavatar.jpg';
?>

<h1>Данные пользователя «<?php echo CHtml::encode($model->username); ?>»</h1>

<?php if (!Yii::app()->user->isGuest){ ?>
<div id="user-info">
	<table>
<?php if ($model->role == Users::ROLE_ADMIN){ ?>
		<tr>
			<td class="text-center" colspan="2"><em>Администратор сайта</em></td>
		</tr>
<?php } ?>
<?php if ($model->role == Users::ROLE_MODER){ ?>
		<tr>
			<td class="text-center" colspan="2"><em>Модератор сайта</em></td>
		</tr>
<?php } ?>
		<tr>
			<td class="text-right"><strong>Имя пользователя</strong></td>
			<td><?php echo CHtml::encode($model->username); ?></td>
		</tr>
		<tr>
			<td class="text-right"><strong>E-mail</strong></td>
			<td><?php echo CHtml::encode($model->email); ?></td>
		</tr>
		<tr>
			<td class="text-right"><strong>Дата регистрации</strong></td>
			<td><?php echo Functions::getDateCP($model->adate); ?> в <?php echo Functions::getTimeCP($model->adate,true); ?></td>
		</tr>
		<tr>
			<td class="text-right"><strong>Аватар</strong></td>
			<td>
				<div class="avatar-round" style="background:url('<?php echo $avatar_src; ?>') no-repeat 0 0;"></div>
			</td>
		</tr>
	</table>
</div>
<?php }else{ ?>
<p>Данные пользователей могут смотреть только зарегистрированные пользователи.</p>
<p>Пожалуйста,&nbsp;&nbsp;<?php echo CHtml::link('авторизируйтесь',array('login')); ?>&nbsp;&nbsp;или&nbsp;&nbsp;<?php echo CHtml::link('зарегистрируйтесь',array('registration')); ?>.</p>
<?php } ?>