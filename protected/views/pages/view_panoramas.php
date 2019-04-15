<?php
$this->layout = '//layouts/fullscreen';
$this->cssInclude[] = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />'."\n";
if (!empty($attributes) && isset($attributes['panoramas_coords']['value']) && $attributes['panoramas_coords']['value']!='' && isset($attributes['panoramas_heading']['value']) && $attributes['panoramas_heading']['value']!='' && isset($attributes['panoramas_pitch']['value']) && $attributes['panoramas_pitch']['value']!='')
{
$zoom_minimap = (isset($attributes['panoramas_map_zoom']['value']) && $attributes['panoramas_map_zoom']['value']!='') ? $attributes['panoramas_map_zoom']['value'] : '14';
$zoom_panorama = (isset($attributes['panoramas_zoom']['value']) && $attributes['panoramas_zoom']['value']!='') ? $attributes['panoramas_zoom']['value'] : '0';
$this->jsInclude[] = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places&amp;amp;key=AIzaSyDMYjlkCEI2dKWcCA0tU-Xfx9L3uqDcxpM"></script>'."\n";
$this->jqCode = '
	initialize();
';
$this->jsCode = '
	var map;
	var panorama;
	function initialize() {
		var startPos = new google.maps.LatLng('.$attributes['panoramas_coords']['value'].');

		var mapOptions = {
			center: startPos,
			zoom: '.$zoom_minimap.',
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("minimap-inner"), mapOptions);

		var panoramaOptions = {
			position: startPos,
			pov: {
				heading: '.$attributes['panoramas_heading']['value'].',
				pitch: '.$attributes['panoramas_pitch']['value'].',
				zoom: '.$zoom_panorama.'
			}
		};

		panorama = new google.maps.StreetViewPanorama(document.getElementById("panorama-inner"), panoramaOptions);
		map.setStreetView(panorama);
	}
';
}
$this->pageTitle = ($page->seo_title!='') ? CHtml::encode($page->seo_title) : Functions::getSubText($page->name,150);
$this->pageDescription = ($page->seo_decryption!='') ? CHtml::encode($page->seo_decryption) : '';
$this->pageKeywords = ($page->seo_keywords!='') ? CHtml::encode($page->seo_keywords) : '';
/*$this->breadcrumbs=array(
	CHtml::encode($page->pageType->name)=>array('pages/list','type'=>CHtml::encode($page->pageType->type)),
	Functions::getSubText($page->name,70,true),
);*/
?>

<h1><?php echo CHtml::encode($page->name); ?></h1>

<div id="page">
<?php if (!empty($attributes) && isset($attributes['panoramas_coords']['value']) && $attributes['panoramas_coords']['value']!='' && isset($attributes['panoramas_heading']['value']) && $attributes['panoramas_heading']['value']!='' && isset($attributes['panoramas_pitch']['value']) && $attributes['panoramas_pitch']['value']!=''){ ?>
	<div id="panorama-inner"></div>
<?php } ?>
	<div class="panorama-map-img-inner">
<?php
if (!empty($images) && ($images[0]['image']!='') && ($images[0]['ext']!=''))
{
	$imgAlt = ($images[0]['alt']!='') ? CHtml::encode($images[0]['alt']) : Functions::getSubText($page->name,100);
	echo CHtml::image('/storage/images/pages/'.CHtml::encode($images[0]['image']).'_small.'.CHtml::encode($images[0]['ext']),$imgAlt,array('class'=>'panorama-img'));
}
?>
		<div id="minimap-inner"></div>
	</div>
	<div class="clear"></div>
<?php if (strip_tags($content)!=''){ ?>
	<div class="panorama-content">
		<?php echo $content; ?>
	</div>
<?php } ?>
</div><!-- /page -->

<?php if ($page->pageType->comments == '1') require_once 'protected/views/pages/_comments.php'; ?>