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
	<div class="upright upright-tourism">
<?php
if (!empty($pages))
{
	$i = 1;
	$columns = array();
	foreach ($pages as $page)
	{
		$image = $this->getImage($page->id);
		if ($image!==null)
		{
			$img = $image->image;
			$ext = $image->ext;
			$alt = $image->alt;
		}
		else
		{
			$img = $ext = $alt = '';
		}
		$columns[$i][] = array(
			$page->id,
			$page->url,
			CHtml::encode($page->name),
			Functions::getSubText($page->content,(350 - mb_strlen($page->name,'utf-8')),true),
			$img,
			$ext,
			$alt,
			Functions::getDateCP($page->adate,true),
		);
		$i++;
		if ($i>3) $i = 1;
	}
	$this->renderPartial($renderPartialName,array(
		'columns'=>$columns,
	));
	if ($pager !== null) require_once 'protected/views/pages/_navigation.php';
}
else
{
?>
		<p>Информация отсутствует</p>
<?php } ?>
	</div><!-- /upright -->
</div><!-- /pages -->