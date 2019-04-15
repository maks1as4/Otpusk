<?php if ($this->title!=''){ ?>
<h2><?php echo $this->title; ?></h2>
<?php } ?>
<?php
$i = 0;
foreach ($pages as $page)
{
	$i++;
?>
<div class="new<?php echo ($i>=3) ? ' new-last' : ''; ?>">
	<div class="sign-image sign-image-index-news">
		<div class="title">
			<?php echo CHtml::link(Functions::getSubText($page['name'],80),array('pages/view','type'=>$page['type'],'id'=>$page['id'],'url'=>$page['url'])); ?>
		</div>
<?php
if ($page['image']!='' && $page['ext']!='')
{
	$alt = ($page['alt']!='') ? CHtml::encode($page['alt']) : Functions::getSubText($page['name'],80);
	$image = CHtml::image('/storage/images/pages/'.$page['image'].'_small.'.$page['ext'],$alt,array('class'=>'shadow','width'=>'246','height'=>'190'));
}
else
	$image = CHtml::image('/images/no-image-246x190.jpg','no image',array('class'=>'shadow','width'=>'246','height'=>'190'));
echo CHtml::link($image,array('pages/view','type'=>$page['type'],'id'=>$page['id'],'url'=>$page['url']));
?>
	</div>
</div>
<?php } ?>
<div class="clear"></div>
<p class="news-all"><?php echo CHtml::link('читать другие новости туризма',array('pages/list','type'=>'news')); ?></p>