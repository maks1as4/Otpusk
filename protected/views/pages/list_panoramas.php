<?php
$p = (isset($_GET['page'])) ? ' стр. '.$_GET['page'] : '';
$this->pageTitle = ($pageType->seo_title!='') ? CHtml::encode($pageType->seo_title).$p : Functions::getSubText($pageType->name,150).$p;
$this->pageDescription = ($pageType->seo_decryption!='') ? CHtml::encode($pageType->seo_decryption).$p : '';
$this->pageKeywords = ($pageType->seo_keywords!='') ? CHtml::encode($pageType->seo_keywords) : '';
/*$this->breadcrumbs = array(
	CHtml::encode($pageType->name),
);*/
?>

<h1><?php echo CHtml::encode($pageType->name); ?></h1>

<div id="pages">
<?php if (!empty($pages)){ ?>
	<div class="panorams">
<?php
$i = $j = 1;
$panoramsCount = count($pages);
foreach ($pages as $page)
{
	$this->renderPartial($renderPartialName,array(
		'image'=>$this->getImage($page->id),
		'pageType'=>$pageType,
		'page'=>$page,
		'panoramsCount'=>$panoramsCount,
		'i'=>$i,
		'j'=>$j,
	));
	$j++;
	if ($j == 4) $j = 1;
	$i++;
}
?>
	</div><!-- /panorams -->
<?php if ($pager !== null) require_once 'protected/views/pages/_navigation.php'; ?>
<?php }else{ ?>
	<p>Нет записей в разделе "<?php echo CHtml::encode($pageType->name); ?>"</p>
<?php } ?>
</div><!-- /pages -->