<?php if (!empty($countriesCol)){ ?>
		<div id="float-countries">
			<div class="column pull-left">
				<ul>
<?php foreach($countriesCol[0] as $column){ ?>
					<li><?php echo CHtml::link($column['name'],array('pages/view','type'=>$column['type'],'id'=>$column['id'],'url'=>$column['url'])); ?></li>
<?php } ?>
				</ul>
			</div>
<?php if (isset($countriesCol[1]) && !empty($countriesCol[1])){ ?>
			<div class="column pull-left">
				<ul>
<?php foreach($countriesCol[1] as $column){ ?>
					<li><?php echo CHtml::link($column['name'],array('pages/view','type'=>$column['type'],'id'=>$column['id'],'url'=>$column['url'])); ?></li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if (isset($countriesCol[2]) && !empty($countriesCol[2])){ ?>
			<div class="column pull-left">
				<ul>
<?php foreach($countriesCol[2] as $column){ ?>
					<li><?php echo CHtml::link($column['name'],array('pages/view','type'=>$column['type'],'id'=>$column['id'],'url'=>$column['url'])); ?></li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if (isset($countriesCol[3]) && !empty($countriesCol[3])){ ?>
			<div class="column pull-left">
				<ul>
<?php foreach($countriesCol[3] as $column){ ?>
					<li><?php echo CHtml::link($column['name'],array('pages/view','type'=>$column['type'],'id'=>$column['id'],'url'=>$column['url'])); ?></li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
<?php if (isset($countriesCol[4]) && !empty($countriesCol[4])){ ?>
			<div class="column-last pull-left">
				<ul>
<?php foreach($countriesCol[4] as $column){ ?>
					<li><?php echo CHtml::link($column['name'],array('pages/view','type'=>$column['type'],'id'=>$column['id'],'url'=>$column['url'])); ?></li>
<?php } ?>
				</ul>
			</div>
<?php } ?>
			<div class="clear"></div>
		</div><!-- /float-countries -->
<?php } ?>