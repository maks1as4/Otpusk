<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->pageTitle = ($page->seo_title!='') ? CHtml::encode($page->seo_title) : Functions::getSubText($page->name,150);
$this->pageDescription = ($page->seo_decryption!='') ? CHtml::encode($page->seo_decryption) : '';
$this->pageKeywords = ($page->seo_keywords!='') ? CHtml::encode($page->seo_keywords) : '';
/*$this->breadcrumbs=array(
	CHtml::encode($page->pageType->name)=>array('pages/list','type'=>CHtml::encode($page->pageType->type)),
	Functions::getSubText($page->name,70,true),
);*/
?>

<div id="page">
	<div class="page-content">
<?php
if (!empty($images) && ($images[0]['image']!='') && ($images[0]['ext']!=''))
{
	$imgAlt = ($images[0]['alt']!='') ? CHtml::encode($images[0]['alt']) : Functions::getSubText($page->name,100);
	echo CHtml::image('/storage/images/pages/'.CHtml::encode($images[0]['image']).'_medium.'.CHtml::encode($images[0]['ext']),$imgAlt,array('class'=>'standard-left shadow'));
}
?>
		<h1><?php echo CHtml::encode($page->name); ?></h1>
		<?php echo $content; ?>
	</div>
	<div class="standard-info-inner">
		<?php echo CHtml::link('полезное туристу',array('pages/list','type'=>$page->pageType->type)); ?>&nbsp;,
		<i class="icon-time"></i> <?php echo Functions::getDateCP($page->adate); ?>
<?php if (isset($page->user->username)){ ?>
		,&nbsp;<i class="icon-user"></i> <?php echo CHtml::link(CHtml::encode($page->user->username),array('users/view','username'=>CHtml::encode($page->user->username)),array('target'=>'_blank')); ?>
<?php } ?>
	</div>
</div><!-- /page -->

<?php if ($page->pageType->comments == '1') require_once 'protected/views/pages/_comments.php'; ?>