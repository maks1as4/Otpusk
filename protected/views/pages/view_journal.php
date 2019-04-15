<?php
$this->showSideJournal = false;
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
$this->jsInclude[] = '<script type="text/javascript" src="//e.issuu.com/embed.js" async="true"></script>'."\n";
$this->pageTitle = ($page->seo_title!='') ? CHtml::encode($page->seo_title) : Functions::getSubText($page->name,150);
$this->pageDescription = ($page->seo_decryption!='') ? CHtml::encode($page->seo_decryption) : '';
$this->pageKeywords = ($page->seo_keywords!='') ? CHtml::encode($page->seo_keywords) : '';
/*$this->breadcrumbs=array(
	'Архив журнала Марка'=>array('pages/list','type'=>CHtml::encode($page->pageType->type)),
	Functions::getSubText($page->name,70,true),
);*/
$titleH1  = CHtml::encode($page->name);
$titleH1 .= (!empty($attributes) && isset($attributes['journal_release_date']['value']) && $attributes['journal_release_date']['value']!='') ? ' <span>'.CHtml::encode($attributes['journal_release_date']['value']).'</span>' : '';
?>

<h1 class="with-date"><?php echo $titleH1; ?></h1>

<div id="page">
<?php if ((!empty($attributes) && isset($attributes['journal_link_id']['value']) && $attributes['journal_link_id']['value']!='')){ ?>
	<div data-configid="<?php echo CHtml::encode($attributes['journal_link_id']['value']); ?>" style="width:700px; height:495px;" class="issuuembed"></div>
<?php } ?>
	<div class="standard-info-inner">
		<?php echo CHtml::link('архив журнала МАРКА',array('pages/list','type'=>$page->pageType->type)); ?>
<?php if (!empty($attributes) && isset($attributes['journal_release_date']['value']) && $attributes['journal_release_date']['value']!=''){ ?>
		,&nbsp;<i class="icon-time"></i> <?php echo CHtml::encode($attributes['journal_release_date']['value']); ?>
<?php } ?>
	</div>
</div><!-- /page -->

<?php if ($page->pageType->comments == '1') require_once 'protected/views/pages/_comments.php'; ?>