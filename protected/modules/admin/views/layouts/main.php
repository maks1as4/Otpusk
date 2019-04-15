<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/control/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/control/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/control/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/control/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/control/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div style="float:left;">
			<div id="logo">Админка</div>
		</div>
		<div style="float:right; padding:18px 20px 0 0;">
			<?php echo CHtml::link('перейти на сайт',Yii::app()->homeUrl); ?>&nbsp;&nbsp;
			<?php echo CHtml::link('выход',array('/users/logout')); ?>
		</div>
		<div style="clear:both;"></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/admin/main/index')),
				array('label'=>'Типы страниц', 'url'=>array('/admin/pagesTypes/index'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
				array('label'=>'Страницы', 'url'=>array('/admin/pages/index')),
				array('label'=>'Картинки', 'url'=>array('/admin/pagesImages/index')),
				array('label'=>'Слайды', 'url'=>array('/admin/slides/index')),
				array('label'=>'Комментарии', 'url'=>array('/admin/comments/index')),
				array('label'=>'Типы атрибутов', 'url'=>array('/admin/attributesTypes/index'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
				array('label'=>'Атрибуты', 'url'=>array('/admin/attributes/index')),
				array('label'=>'Пользователи', 'url'=>array('/admin/users/index')),
				array('label'=>'Настройки', 'url'=>array('/admin/options/index'), 'visible'=>Yii::app()->user->checkAccess(Users::ROLE_ADMIN)),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'homeLink'=>CHtml::link('Главная', array('/admin/main/index')),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
