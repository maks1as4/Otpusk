<div id="footer">
	<div class="container_14">
		<div class="grid_4">
			<?php echo CHtml::link(CHtml::image('/images/logo-small.png'),Yii::app()->homeUrl); ?>
			<!--div class="social">
				<img src="/images/social/facebook_24x24.png" />
				<img src="/images/social/twitter_24x24.png" />
				<img src="/images/social/vkontakte_24x24.png" />
			</div-->
		</div>
		<div class="grid_3">
			<h3>Навигация</h3>
			<ul>
				<li><?php echo CHtml::link('Куда поехать',array('/pages/list','type'=>'countries')); ?></li>
				<li><?php echo CHtml::link('Нужно знать',array('/pages/list','type'=>'tourism')); ?></li>
				<li><?php echo CHtml::link('Новости',array('/pages/list','type'=>'news')); ?></li>
				<li><?php echo CHtml::link('Информация о нас',array('/site/page', 'view'=>'about')); ?></li>
				<li><?php echo CHtml::link('Контакты',array('/site/contact')); ?></li>
			</ul>
		</div>
		<div class="grid_3">
			<h3>Услуги, сервисы</h3>
			<ul>
				<li><?php echo CHtml::link('Журнал online',array('/pages/list','type'=>'journal')); ?></li>
				<li><?php echo CHtml::link('Медиа Кит 2014',array('downloader/index','type'=>'pdf','file'=>'media_kit_2014'),array('rel'=>'nofollow')); ?></li>
				<!--li><a href="javascript://">Забронировать отель</a></li-->
				<!--li><a href="javascript://">Купить билет</a></li-->
			</ul>
		</div>
		<div class="grid_4">
			<p class="text-center">© Марка<br /><?php echo date('Y'); ?></p>
		</div>
		<div class="clear"></div>
	</div>
</div><!-- /footer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter24198517 = new Ya.Metrika({id:24198517,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24198517" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
