<?php if ($this->title!=''){ ?>
<h2><?php echo $this->title; ?></h2>
<?php } ?>
<?php
$i = 1;
$count_tourism = count($pages);
foreach ($pages as $page)
{
?>
<div class="<?php echo ($i == $count_tourism) ? 'row-last' : 'row'; ?> shadow">
	<div class="sign-image sign-image-index-blocks">
		<div class="title">
			<?php echo CHtml::link(Functions::getSubText($page['name'],100),array('pages/view','type'=>$page['type'],'id'=>$page['id'],'url'=>$page['url']))?>
		</div>
<?php
if ($page['image']!='' && $page['ext']!='')
{
	$alt = ($page['alt']!='') ? CHtml::encode($page['alt']) : Functions::getSubText($page['name'],100);
	$image = CHtml::image('/storage/images/pages/'.$page['image'].'_big.'.$page['ext'],$alt,array('width'=>'380','height'=>'250'));
}
else
	$image = CHtml::image('/images/no-image-380x250.jpg','no image',array('width'=>'380','height'=>'250'));
echo CHtml::link($image,array('pages/view','type'=>$page['type'],'id'=>$page['id'],'url'=>$page['url']));
?>
	</div>
	<p class="description"><?php echo Functions::getSubText($page['content'],230,true); ?> <?php echo CHtml::link('читать&nbsp;подробнее',array('pages/view','type'=>$page['type'],'id'=>$page['id'],'url'=>$page['url'])); ?></p>
</div>
<?php
	$i++;
}
?>
<?php echo CHtml::link('узнать где еще можно отдохнуть',array('pages/list','type'=>'countries')); ?>