<div class="navigation navigation-<?php echo CHtml::encode($pageType->type); ?>">
	<?php $this->widget('CLinkPager',array(
		'cssFile'=>'/css/pager.css',
		'pages'=>$pager,
		'maxButtonCount'=>5,
		'header'=>'',
		'prevPageLabel'=>'&larr; назад',
		'nextPageLabel'=>'вперед &rarr;',
	)); ?>
</div>