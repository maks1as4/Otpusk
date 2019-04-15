<?php if (!empty($menu)){ ?>
<ul id="menu">
<?php foreach ($menu as $k=>$m)
{
	$classLink = ($m['subMenu'] == '') ? 'menu-link' : 'menu-link drop';
?>
	<li class="menu-li<?php echo ($k === 0) ? ' first' : ''; ?><?php echo ($m['active']) ? ' active' : ''; ?>">
		<?php echo CHtml::link($m['title'],$m['url'],array('class'=>$classLink)); ?>
<?php if ($m['subMenu'] != '') include_once(Yii::getPathOfAlias('application.components.views.'.$m['subMenu']).'.php'); ?>
	</li>
<?php } ?>
</ul>
<?php } ?>