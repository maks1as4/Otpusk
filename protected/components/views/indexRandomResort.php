<div class="item side-resort elevated">
<?php if ($this->title!=''){ ?>
	<h3><?php echo $this->title; ?></h3>
<?php } ?>
<?php
foreach ($pages as $page)
{
	$image = $this->getImage($page->id);
	$pageType = $this->getPageType($page->id_page_type);
	if (!empty($image) && ($image->image!='') && ($image->ext!=''))
	{
		$imgAlt = ($image->alt!='') ? $image->alt : Functions::getSubText($page->name,100);
		$imgSrc = CHtml::image('/storage/images/pages/'.CHtml::encode($image->image).'_small.'.CHtml::encode($image->ext),$imgAlt);
		echo CHtml::link($imgSrc,array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url));
	}
?>
	<?php echo CHtml::link(Functions::getSubText($page->name,100),array('pages/view','type'=>$pageType->type,'id'=>$page->id,'url'=>$page->url),array('class'=>'title')); ?>
	<p><?php echo Functions::getSubText($page->content,150,true); ?></p>
<?php } ?>
</div>