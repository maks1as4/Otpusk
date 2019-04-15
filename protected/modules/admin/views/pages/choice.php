<?php
$this->breadcrumbs=array(
	'Журнал страниц'=>array('index'),
	'Тип страницы',
);

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
);
?>

<h1>Выберите тип страницы</h1>

<div id="choice">
<?php if (!empty($models)){ ?>
<?php foreach ($models as $type){ ?>
	<div class="row">
		<span class="name"><?php echo CHtml::link(CHtml::encode($type->name),array('create','type'=>$type->type)); ?></span>
<?php if ($type->description!=''){ ?>
		<br /><span class="description"><?php echo CHtml::encode($type->description); ?></span>
<?php } ?>
	</div>
<?php } ?>
<?php }else{ ?>
	<p class="empty">
		<span class="name">Типы страниц отсутствуют.</span><br />
		<span class="description">Прежде чем добавлять страницы создайте типы страниц.</span>
	</p>
<?php } ?>
</div>