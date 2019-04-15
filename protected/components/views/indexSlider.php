<?php
if (!empty($slides))
{
	$slidesCount = count($slides);
?>
<div id="slideshow">
	<div class="slides shadow">
<?php
foreach ($slides as $slide)
{
	if ($slide->image!='' && $slide->ext!='')
	{
		$sliderClass = ($slide->name!='' || $slide->content!='') ? ' sign-image sign-image-slider' : '';
		$sliderColor = ($slide->color=='1') ? ' sign-image-slider-white' : '';
?>
		<div class="slider-item">
			<div class="slider-item-image<?php echo $sliderClass.$sliderColor; ?>">
				<div class="title">
<?php if ($slide->name!=''){ ?>
					<div class="slider-item-title"><?php echo CHtml::encode($slide->name); ?></div>
<?php } ?>
<?php if ($slide->content!=''){ ?>
					<?php echo CHtml::encode($slide->content); ?>
<?php if ($slide->link!=''){ ?>
				&nbsp;~&nbsp;&nbsp;<strong><?php echo CHtml::link('читать подробнее',$slide->link); ?></strong>
<?php } ?>
<?php } ?>
				</div>
<?php if ($slide->link!=''){ ?>
			<?php echo CHtml::link(CHtml::image('/storage/images/slides/'.$slide->image.'.'.$slide->ext,null),$slide->link); ?>
<?php }else{ ?>
			<?php echo CHtml::image('/storage/images/slides/'.$slide->image.'.'.$slide->ext,null); ?>
<?php } ?>
			</div>
		</div>
<?php
	}
}
?>
	</div><!-- /slides -->
<?php if ($slidesCount>1){ ?>
	<div class="slide-control">
		<div id="prev" href="javascript://"><span class="websymbols"><</span></div>
		<div id="next" href="javascript://"><span class="websymbols">></span></div>
	</div><!-- /slide-control -->
	<ul id="slide-nav">
<?php for ($i=1; $i<=$slidesCount; $i++){ ?>
		<li><a href="javascript://"></a></li>
<?php } ?>
	</ul><!-- /slide-nav -->
<?php } ?>
</div><!-- /slideshow -->
<?php } ?>