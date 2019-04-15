<h1>Панель управления</h1>

<?php if (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)){ ?>
<?php echo CHtml::link('SiteMap',array('/admin/sitemap/index')); ?>
<br /><br />
<?php } ?>
<?php echo CHtml::link('перейти на сайт',Yii::app()->homeUrl); ?>&nbsp;&nbsp;
<?php echo CHtml::link('выход',array('/users/logout')); ?>&nbsp;&nbsp;