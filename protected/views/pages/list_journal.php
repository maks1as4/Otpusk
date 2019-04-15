<?php
$this->showSideJournal = false;
$p = (isset($_GET['page'])) ? ' стр. '.$_GET['page'] : '';
$this->pageTitle = ($pageType->seo_title!='') ? CHtml::encode($pageType->seo_title).$p : 'Журнал Марка online'.$p;
$this->pageDescription = ($pageType->seo_decryption!='') ? CHtml::encode($pageType->seo_decryption).$p : '';
$this->pageKeywords = ($pageType->seo_keywords!='') ? CHtml::encode($pageType->seo_keywords) : '';
/*$this->breadcrumbs = array(
	'Архив журнала Марка',
);*/
?>

<h1>Журнал Марка</h1>

<div id="pages">
<?php if (!empty($pages)){ ?>
	<div class="journal">
<?php
$i = $j = 1;
$journalsCount = count($pages);
foreach ($pages as $page)
{
	$this->renderPartial($renderPartialName,array(
		'image'=>$this->getImage($page->id),
		'attributes'=>$this->getAttributesArray($page->id),
		'pageType'=>$pageType,
		'page'=>$page,
		'journalsCount'=>$journalsCount,
		'i'=>$i,
		'j'=>$j,
	));
	$j++;
	if ($j == 4) $j = 1;
	$i++;
}
?>
	</div><!-- /journal -->
<?php if ($pager !== null) require_once 'protected/views/pages/_navigation.php'; ?>
<?php }else{ ?>
	<p>Архив пустой.</p>
<?php } ?>
</div><!-- /pages -->