<?php $this->beginContent('//layouts/main'); ?>
<div class="grid_10">
	<?php echo $content; ?>
</div>
<div class="grid_4">
	<div id="right-sidebar">
<?php if ($this->showSideAuth) $this->renderPartial('//layouts/_authorization'); ?>
<?php
if ($this->showSideJournal)
{
	$this->widget('RecentPages',array(
		'title'=>'новый номер',
		'render'=>'sidebarRecentJournal',
		'type'=>'journal',
		'limit'=>1,
	));
}
?>
		<div class="menu-services item">
			<h3>Наши услуги</h3>
			<ul>
				<!--li><a href="javascript://">Забронировать отель</a></li-->
				<!--li><a href="javascript://">Купить билет</a></li-->
				<li><?php echo CHtml::link('Эксклюзивный маршрут по региону МАРКЕ (Италия)',array('downloader/index','type'=>'pdf','file'=>'ekskluzivnii_marshrut_po_regionu_MARKE_Italy')); ?></li>
				<li><?php echo CHtml::link('Панорамы',array('pages/list','type'=>'panoramas')); ?></li>
			</ul>
		</div><!-- /menu-services -->
	</div><!-- /right-sidebar -->
</div>
<?php $this->endContent(); ?>