<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php if ($this->pageDescription != ''){ ?>
<meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
<?php }?>
<?php if ($this->pageKeywords != ''){ ?>
<meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
<?php }?>
<link rel="icon" type="image/x-icon" href="favicon.ico?28022014" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico?28022014" />
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Exo+2&subset=cyrillic" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/1120.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css?16042014" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.limit.css?01042014" />
<!--[if lt IE 9]>
<style type="text/css">
#content,
#page .page-content .note,
#page .page-content .note-left,
#page .page-content .note-right,
#page .page-content .blockquote,
#page .page-content .blockquote-left,
#page .page-content .blockquote-right,
.shadow {outline:1px solid #b4b4b4;}
</style>
<![endif]-->
<?php if (!empty($this->cssInclude)) foreach ($this->cssInclude as $inc) echo $inc; ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php if (!empty($this->jsInclude)) foreach ($this->jsInclude as $inc) echo $inc; ?>
<?php if (!empty($this->cssCode)){ ?>
<style type="text/css">
<?php echo $this->cssCode; ?>
</style>
<?php } ?>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
jQuery(document).ready(function($) {
	$('.sign-image').hover(
		function() {
			$(this).find('div.title').find('a').css('text-decoration','underline');
		},
		function() {
			$(this).find('div.title').find('a').css('text-decoration','none');
		}
	);

	$('.j-load').click(function() {
		$('#other-journals').slideDown(300);
	});

<?php if (!empty($this->jqCode)) echo $this->jqCode; ?>
});
//--><!]]>
</script>
<script type="text/javascript">
<?php if (!empty($this->jsCode)) echo $this->jsCode; ?>
</script>

<!-- Google Analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-48711842-1', 'otpusk-ekb.ru');
	ga('send', 'pageview');

</script>
<!-- /Google Analytics -->

</head>
<body>
<div id="wrapper">
	<div id="content" class="container_14">
		<?php $this->renderPartial('//layouts/_header'); ?>
		<div class="grid_14">
			<?php $this->widget('MainMenu'); ?>
		</div>
		<div class="clear"></div>
<?php if ($this->showIndexSNB){ ?>
		<div id="snb" class="grid_14">
			<div class="grid_10 alpha">
				<div class="grid_10 alpha omega">
					<?php $this->widget('Slider'); ?>
				</div>
				<div class="grid_10 alpha omega">
					<?php $this->widget('RecentPages',array(
						'title'=>'Последние новости туризма и отдыха',
						'render'=>'indexRecentNews',
						'type'=>'news',
					)); ?>
				</div>
			</div>
			<div class="grid_4 omega">
<?php
if ($this->showSideJournal)
{
	$this->widget('RecentPages',array(
		'title'=>'новый номер',
		'render'=>'sidebarRecentJournal',
		'type'=>'journal',
		'limit'=>1,
	));
}
?>
				<!--div class="banners shadow">
					<p>Место для рекламы</p>
				</div-->
			</div>
			<div class="clear"></div>
		</div><!-- /snb -->
		<div class="clear"></div>
<?php } ?>
<?php if (isset($this->breadcrumbs) && !empty($this->breadcrumbs)){ ?>
		<div class="grid_14">
			<div id="breadcrumbs">
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?>
			</div>
		</div>
		<div class="clear"></div>
<?php } ?>
		<?php echo $content; ?>
	</div><!-- /content -->
</div><!-- /wrapper -->
<?php $this->renderPartial('//layouts/_footer'); ?>
</body>
</html>