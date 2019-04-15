<?php if ($j == 1){ ?>
<div class="row">
<?php } ?>
	<div class="cell">
<?php
if (!empty($image) && ($image->image!='') && ($image->ext!=''))
{
	$imgAlt = ($image->alt!='') ? $image->alt : Functions::getSubText($page->name,100);
	$imgSrc = CHtml::image('/storage/images/pages/'.CHtml::encode($image->image).'_mini.'.CHtml::encode($image->ext),$imgAlt);
	echo CHtml::link($imgSrc,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url));
}
?>
		<?php echo CHtml::link(Functions::getSubText($page->name,200),array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url)); ?>
	</div>
<?php if (($j == 3) || ($i == $panoramsCount)){ ?>
	<div class="clear"></div>
</div><!-- /row -->
<?php } ?>