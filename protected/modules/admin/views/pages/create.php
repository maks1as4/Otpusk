<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Журнал страниц'=>array('index'),
	'Тип страницы'=>array('choice'),
	'Создать страницу "'.$pageType->name.'"',
);

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
);
?>

<h1>Создать страницу "<?php echo $pageType->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'pageType'=>$pageType)); ?>