<?php
$this->showIndexSNB = true;
$this->jsInclude[] = '<script type="text/javascript" src="'.Yii::app()->request->baseUrl.'/js/jquery.cycle.all.js"></script>'."\n";
$this->jqCode = '
	$(window).load(function() {
		$("#slideshow").fadeIn("fast");
		$("#slideshow .slides img").show();
		$("slideshow .slides").fadeIn("slow");
		$("slideshow .slide-control").fadeIn("slow");
		$("#slide-nav").fadeIn("slow");
		$(".slides").cycle({
			fx: "cover", 
			speed: "slow",
			timeout: 10000,
			random: 0,
			nowrap: 0,
			pause: 1,
			prev: "#prev", 
			next: "#next",
			pager: "#slide-nav",
			pagerAnchorBuilder: function(idx, slide) {
				return "#slide-nav li:eq(" + (idx) + ") a";
			},
			slideResize: true,
			containerResize: false,
			height: "auto",
			fit: 1,
			before: function() {
				$(this).parent().find(".slider-item.current").removeClass("current");
			},
			after: onAfter
		});
	});

	function onAfter(curr, next, opts, fwd) {
		var $ht = $(this).height();
		$(this).parent().height($ht);
		$(this).addClass("current");
	}

	$(window).load(function() {
		var $ht = $(".slider-item.current").height();
		$(".slides").height($ht);
	});

	$(window).resize(function() {
		var $ht = $(".slider-item.current").height();
		$(".slides").height($ht);
	});
';
$this->pageTitle = 'Журнал МАРКА Екатеринбург, информация для туристов, журнал о путешествиях МАРКА, туроператоры, турагенства Екатеринбурга, куда поехать отдыхать';
$this->pageDescription = 'Полезная информация для путешественников, журнал о путешествиях МАРКА Екатеринбург';
?>

<div class="grid_5 alpha ribbon">
	<?php $this->widget('RecentPages',array(
		'title'=>'Где отдохнуть',
		'render'=>'indexRecentCountry',
		'type'=>'countries',
		'limit'=>4,
	)); ?>
</div>
<div class="grid_5 omega ribbon">
	<?php $this->widget('RecentPages',array(
		'title'=>'Полезное туристу',
		'render'=>'indexRecentTourism',
		'type'=>'tourism',
		'limit'=>4,
	)); ?>
</div>
<div class="grid_10 alpha omega about">
	<h1><em>Журнал МАРКА</em></h1>
	<p><em>Что такое МАРКА? Назвав так журнал, мы тоже хотим «отражать жизнь», жизнь НАШЕГО С ВАМИ мегаполиса, а точнее, ту грань этой многообразной жизни, которая видится в ракурсе ПУТЕШЕСТВЕННИКА, мечтающего о странствиях и приключениях. Мы хотим рассказать вам об изумительных местах, городах и странах, а также обо всем, что может быть полезно знать отправляясь в путь...</em></p>
	<?php echo CHtml::link('подробнее',array('site/page','view'=>'about')); ?>
</div>