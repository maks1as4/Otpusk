<?php
/* @var $this SitemapController */

$this->breadcrumbs=array(
	'SiteMap',
);
?>

<?php if(Yii::app()->user->hasFlash('sitemapCreated')){ ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('sitemapCreated'); ?>
</div>

<?php } ?>

<h1>Обновить SiteMap</h1>

<?php echo CHtml::link('обновить',array('/admin/sitemap/update','showResults'=>1)); ?>