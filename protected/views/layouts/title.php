<?php $this->beginContent('//layouts/main'); ?>
<div id="index" class="grid_10">
	<?php echo $content; ?>
</div>
<div class="grid_4">
	<div id="right-sidebar">
<?php if ($this->showSideAuth) $this->renderPartial('//layouts/_authorization'); ?>
		<div class="item">
			<h3>Погода, <?php echo Functions::getDateCP(date('Y-m-d'),true); ?></h3>
			<!-- Gismeteo informer START -->
			<link rel="stylesheet" type="text/css" href="http://www.gismeteo.ru/static/css/informer2/gs_informerClient.min.css">
			<div id="gsInformerID-dM3Ye0oRDMk5pk" class="gsInformer" style="width:300px;height:207px">
				<div class="gsIContent">
					<div id="cityLink">
						<a href="http://www.gismeteo.ru/city/daily/4517/" target="_blank">Погода в Екатеринбурге</a>
					</div>
					<div class="gsLinks">
						<table>
						<tr>
						<td>
							<div class="leftCol">
								<a href="http://www.gismeteo.ru" target="_blank">
									<img alt="Gismeteo" title="Gismeteo" src="http://www.gismeteo.ru/static/images/informer2/logo-mini2.png" align="absmiddle" border="0" />
									<span>Gismeteo</span>
								</a>
							</div>
							<div class="rightCol">
								<a href="http://www.gismeteo.ru/city/weekly/4517/" target="_blank">Прогноз на 2 недели</a>
							</div>
						</td>
						</tr>
						</table>
					</div>
				</div>
			</div>
			<script src="http://www.gismeteo.ru/ajax/getInformer/?hash=dM3Ye0oRDMk5pk" type="text/javascript"></script>
			<!-- Gismeteo informer END -->
		</div>
		<div class="menu-services item">
			<h3>Наши услуги</h3>
			<ul>
				<!--li><a href="javascript://">Забронировать отель</a></li-->
				<!--li><a href="javascript://">Купить билет</a></li-->
				<li><?php echo CHtml::link('Эксклюзивный маршрут по региону МАРКЕ (Италия)',array('downloader/index','type'=>'pdf','file'=>'ekskluzivnii_marshrut_po_regionu_MARKE_Italy')); ?></li>
				<li><?php echo CHtml::link('Панорамы',array('pages/list','type'=>'panoramas')); ?></li>
			</ul>
		</div><!-- /menu-services -->
		<!--div class="item">
			<h3>Мы в соцсетях</h3>
			<div class="social">
				<img src="images/social/facebook.png" />
				<img src="/images/social/twitter.png" />
				<img src="/images/social/vkontakte.png" />
			</div>
		</div-->
	</div><!-- /right-sidebar -->
</div>
<?php $this->endContent(); ?>