<?php
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->pageTitle = ($page->seo_title!='') ? CHtml::encode($page->seo_title) : Functions::getSubText($page->name,150);
$this->pageDescription = ($page->seo_decryption!='') ? CHtml::encode($page->seo_decryption) : '';
$this->pageKeywords = ($page->seo_keywords!='') ? CHtml::encode($page->seo_keywords) : '';
/*$this->breadcrumbs=array(
	CHtml::encode($page->pageType->name)=>array('pages/list','type'=>CHtml::encode($page->pageType->type)),
	Functions::getSubText($page->name,70,true),
);
Yii::import('application.extensions.imperavi-redactor.ImperaviRedactorWidget');
$this->widget('ImperaviRedactorWidget', array(
	'selector' => '.memo-coment',
	'options' => array(
		'lang' => 'ru',
		'toolbar' => true,
		'pastePlainText' => true,
		'minHeight' => 100,
		'buttons' => array(
			'bold', 'italic', 'deleted', '|', 'link',
		),
	),
));*/
?>

<h1><?php echo CHtml::encode($page->name); ?></h1>

<div id="page">
<?php
if (!empty($images) && ($images[0]['image']!='') && ($images[0]['ext']!=''))
{
	$imgAlt = ($images[0]['alt']!='') ? CHtml::encode($images[0]['alt']) : Functions::getSubText($page->name,100);
	echo CHtml::image('/storage/images/pages/'.CHtml::encode($images[0]['image']).'_medium.'.CHtml::encode($images[0]['ext']),$imgAlt,array('class'=>'page-image page-image-'.$page->pageType->type));
}
?>
	<div class="page-content">
		<?php echo $content; ?>
	</div>
	<p class="page-info page-info-<?php echo $page->pageType->type; ?>">
		<span class="page-calendar page-calendar-<?php echo $page->pageType->type; ?>"></span> 
		<span class="page-date page-date-<?php echo $page->pageType->type; ?>"><?php echo Functions::getDateCP($page->adate); ?></span>
<?php if (isset($page->user->username)){ ?>
		,&nbsp;<span class="page-author page-author-<?php echo $page->pageType->type; ?>"></span>
		<span class="page-user page-user-<?php echo $page->pageType->type; ?>"><?php echo CHtml::encode($page->user->username); ?></span>
<?php } ?>
	</p>
</div><!-- /page -->

<?php if ($page->pageType->comments == '1') require_once 'protected/views/pages/_comments.php'; ?>