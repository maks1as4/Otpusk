<?php
if (!empty($pages)){
	$attributes = $this->getAttributesArray($pages[0]['id']);
	$linkTitle  = CHtml::encode($pages[0]['name']);
	$linkTitle  .= (!empty($attributes) && isset($attributes['journal_release_date']['value']) && $attributes['journal_release_date']['value']!='') ? ' '.CHtml::encode($attributes['journal_release_date']['value']) : '';
?>
<div class="item journals">
	<div class="head shadow">
		<?php echo $this->title; ?>
	</div>
<?php if ($pages[0]['image']!='' && $pages[0]['ext']!=''){ ?>
	<div class="journal-inner shadow">
		<div class="sign-image sign-image-sidebar-journal">
			<div class="title">
				<?php echo CHtml::link($linkTitle,array('pages/view','type'=>$pages[0]['type'],'id'=>$pages[0]['id'],'url'=>$pages[0]['url'])); ?>
			</div>
<?php
$imgSrc = CHtml::image('/storage/images/pages/'.CHtml::encode($pages[0]['image']).'_medium.'.CHtml::encode($pages[0]['ext']),Functions::getSubText($pages[0]['name'],100),array('class'=>'list-image'));
echo CHtml::link($imgSrc,array('pages/view','type'=>$pages[0]['type'],'id'=>$pages[0]['id'],'url'=>$pages[0]['url']));
?>
		</div>
		<div id="other-journals">
			<ul>
				<li><?php echo CHtml::link('Выпуск №3 февраль 2014',array('pages/view','type'=>'journal','id'=>58,'url'=>'vipusk-3')); ?></li>
				<li><?php echo CHtml::link('Выпуск №2 декабрь-январь 2014',array('pages/view','type'=>'journal','id'=>57,'url'=>'vipusk-2')); ?></li>
				<li><?php echo CHtml::link('Выпуск №1 осень 2013',array('pages/view','type'=>'journal','id'=>1,'url'=>'vipusk-1')); ?></li>
				<li><?php echo CHtml::link('Архив журнала',array('pages/list','type'=>'journal')); ?></li>
			</ul>
		</div>
		<div id="j-load-outer">
			<a href="javascript://" class="dashed j-load">другие номера</a>
			<p class="j-load"><img src="/images/arrow-down.jpg" /></p>
		</div>
	</div>
<?php
} else echo CHtml::link($linkTitle,array('pages/view','type'=>$pages[0]['type'],'id'=>$pages[0]['id'],'url'=>$pages[0]['url']));
?>
</div><!-- /journals -->
<?php } ?>