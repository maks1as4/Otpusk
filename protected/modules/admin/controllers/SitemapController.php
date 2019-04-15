<?php

class SitemapController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index', 'update'),
				'roles'=>array(Users::ROLE_ADMIN),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUpdate($showResults=1)
	{
		$currentDate = date("Y-m-d"); // текущая дата
		$n = "\r\n"; // перевод на новую строку
        $t = "\t"; // табуляция

		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>'.$n.'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(Yii::app()->homeUrl).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>daily</changefreq>'.$n.$t.$t.'<priority>0.9</priority>'.$n.$t.'</url>';
		$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(array('/site/page','view'=>'about')).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>monthly</changefreq>'.$n.$t.$t.'<priority>0.7</priority>'.$n.$t.'</url>';
		$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(array('/site/contact')).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>monthly</changefreq>'.$n.$t.$t.'<priority>0.7</priority>'.$n.$t.'</url>';
		$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(array('/site/page','view'=>'vacancy')).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>monthly</changefreq>'.$n.$t.$t.'<priority>0.7</priority>'.$n.$t.'</url>';

		$pids = array();
		$pages = Pages::model()->findAll('visibility=1');
		foreach ($pages as $page)
		{
			$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(array('/pages/view','type'=>$page->pageType->type,'id'=>$page->id,'url'=>$page->url)).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>monthly</changefreq>'.$n.$t.$t.'<priority>1</priority>'.$n.$t.'</url>';
			if (!in_array($page->id_page_type,$pids)) $pids[] = $page->id_page_type;
		}

		$criteria = new CDbCriteria();
		$criteria->addInCondition('id',$pids);
		$pagesTypes = PagesTypes::model()->findAll($criteria);
		unset ($pids);
		foreach ($pagesTypes as $type)
		{
			$sitemap .= $n.$t.'<url>'.$n.$t.$t.'<loc>'.Yii::app()->getBaseUrl(true).CHtml::normalizeUrl(array('/pages/list','type'=>$type->type)).'</loc>'.$n.$t.$t.'<lastmod>'.$currentDate.'</lastmod>'.$n.$t.$t.'<changefreq>daily</changefreq>'.$n.$t.$t.'<priority>0.8</priority>'.$n.$t.'</url>';
		}
		$sitemap .= $n.'</urlset>';

		$rootDir = Yii::getPathOfAlias('webroot');
		$mapFile = $rootDir.DIRECTORY_SEPARATOR.'sitemap.xml';

		chmod ($rootDir, 0755);

		if (is_file($mapFile))
			chmod ($mapFile, 0744);

		$fop = fopen($mapFile,"w");
		if (fwrite($fop, $sitemap))
		{
			if ($showResults==1) Yii::app()->user->setFlash('sitemapCreated','Сайтмап был успешно обновлен.');
		}
		else
		{
			if ($showResults==1) Yii::app()->user->setFlash('sitemapCreated','Произошла ошибка при обновлении сайтапа.');
		}

		fclose($fop);
		unset($sitemap);
		chmod ($mapFile, 0444);
		chmod ($rootDir, 0555);

		if ($showResults==1) $this->redirect(array('index'));
	}
}