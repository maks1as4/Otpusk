<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Страница не найдена, ошибка 404</title>
<link rel="icon" type="image/x-icon" href="favicon.ico?28022014" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico?28022014" />
<link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Bad+Script&subset=cyrillic' />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/1120.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.limit.css?01042014" />

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
		<?php include_once(Yii::getPathOfAlias('application.views.layouts._header').'.php'); ?>
		<div class="grid_14">
			<div id="error40x">
				<h1>Запрашиваемая вами страница заблокирована или не существует.</h1>
				<?php echo CHtml::image('/images/logo404.png','error 404',array('class'=>'logo')); ?>
				<div class="inner error404">
					<p>Страница, которую вы искали, не найдена :(</p>
					<p>Это могло произойти:</p>
					<ul>
						<li>из-за не правильно введенного адреса;</li>
						<li>страница потеряла свою актуальность и была отправлена в архив.</li>
					</ul>
					<div class="button">
						<?php echo CHtml::link('перейти на главную страницу',Yii::app()->homeUrl,array('class'=>'button-link')); ?>
					</div>
				</div>
			</div><!-- /error40x -->
		</div>
		<div class="clear"></div>
	</div><!-- /content -->
</div><!-- /wrapper -->
<?php include_once(Yii::getPathOfAlias('application.views.layouts._footer').'.php'); ?>
</body>
</html>