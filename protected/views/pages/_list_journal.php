<?php
$linkTitle  = CHtml::encode($page->name);
$linkTitle .= (!empty($attributes) && isset($attributes['journal_release_date']['value']) && $attributes['journal_release_date']['value']!='') ? ' '.CHtml::encode($attributes['journal_release_date']['value']) : '';
?>
<?php if ($j == 1){ ?>
<div class="row">
<?php } ?>
	<div class="cell<?php echo ($j==1) ? ' cell-first' : ''; ?>">
<?php
if (!empty($image) && ($image->image!='') && ($image->ext!=''))
{
	$imgAlt = ($image->alt!='') ? $image->alt : Functions::getSubText($page->name,100);
	$imgSrc = CHtml::image('/storage/images/pages/'.CHtml::encode($image->image).'_small.'.CHtml::encode($image->ext),$imgAlt,array('class'=>'list-image'));
	$printImage = CHtml::link($imgSrc,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url));
?>
		<div class="sign-image sign-tee-journal shadow">
			<div class="title">
				<?php echo CHtml::link($linkTitle,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url)); ?>
			</div>
			<?php echo $printImage; ?>
		</div>
<?php
} else echo CHtml::link($linkTitle,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url));
?>
	</div>
<?php if (($j == 3) || ($i == $journalsCount)){ ?>
	<div class="clear"></div>
</div><!-- /row -->
<?php } ?>