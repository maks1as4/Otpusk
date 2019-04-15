<div class="column">
<?php
if (isset($columns[1]) && !empty($columns[1]))
{
	foreach ($columns[1] as $column)
	{
?>
	<div class="cell shadow">
		<h2><?php echo CHtml::link($column[2],array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1])); ?></h2>
<?php
if ($column[4]!='' && $column[5]!='')
{
	$alt = ($column[6]!='') ? $column[6] : Functions::getSubText($column[2],100);
	$src = CHtml::image('/storage/images/pages/'.$column[4].'_small.'.$column[5],$alt,array('width'=>'246','height'=>'190'));
	echo CHtml::link($src,array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1]));
}
?>
		<p class="description"><?php echo $column[3]; ?></p>
	</div>
<?php
	}
}
?>
</div>
<div class="column">
<?php
if (isset($columns[2]) && !empty($columns[2]))
{
	foreach ($columns[2] as $column)
	{
?>
	<div class="cell shadow">
		<h2><?php echo CHtml::link($column[2],array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1])); ?></h2>
<?php
if ($column[4]!='' && $column[5]!='')
{
	$alt = ($column[6]!='') ? $column[6] : Functions::getSubText($column[2],100);
	$src = CHtml::image('/storage/images/pages/'.$column[4].'_small.'.$column[5],$alt,array('width'=>'246','height'=>'190'));
	echo CHtml::link($src,array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1]));
}
?>
		<p class="description"><?php echo $column[3]; ?></p>
	</div>
<?php
	}
}
?>
</div>
<div class="column column-last">
<?php
if (isset($columns[3]) && !empty($columns[3]))
{
	foreach ($columns[3] as $column)
	{
?>
	<div class="cell shadow">
		<h2><?php echo CHtml::link($column[2],array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1])); ?></h2>
<?php
if ($column[4]!='' && $column[5]!='')
{
	$alt = ($column[6]!='') ? $column[6] : Functions::getSubText($column[2],100);
	$src = CHtml::image('/storage/images/pages/'.$column[4].'_small.'.$column[5],$alt,array('width'=>'246','height'=>'190'));
	echo CHtml::link($src,array('pages/view','type'=>'countries','id'=>$column[0],'url'=>$column[1]));
}
?>
		<p class="description"><?php echo $column[3]; ?></p>
	</div>
<?php
	}
}
?>
</div>
<div class="clear"></div>