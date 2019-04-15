<div class="list-item list-item-<?php echo $pageType->type; ?>">
	<p class="list-date">
		<?php echo Functions::getDateCP($page->adate); ?>
	</p>
<?php
if (!empty($image) && ($image->image!='') && ($image->ext!=''))
{
	$imgAlt = ($image->alt!='') ? $image->alt : Functions::getSubText($page->name,100);
	$imgSrc = CHtml::image('/storage/images/pages/'.CHtml::encode($image->image).'_mini.'.CHtml::encode($image->ext),$imgAlt,array('class'=>'list-image'));
	echo CHtml::link($imgSrc,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url));
}
?>
	<?php echo CHtml::link(Functions::getSubText($page->name,200),array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url),array('class'=>'list-title')); ?>
	<div class="list-content">
		<?php echo Functions::getSubText($page->content,280,true); ?>
	</div>
</div>