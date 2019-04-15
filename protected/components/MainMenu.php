<?php

class MainMenu extends CWidget
{
	public function run()
	{
		$menu = array(
			array(
				'title'=>'Главная',
				'url'=>array('site/index'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Куда поехать',
				'url'=>array('pages/list','type'=>'countries'),
				'active'=>false,
				'subMenu'=>'_mainMenuCountriy',
			),
			array(
				'title'=>'Новости туризма',
				'url'=>array('pages/list','type'=>'news'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Полезное туристу',
				'url'=>array('pages/list','type'=>'tourism'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Фото истории',
				'url'=>array('site/page','view'=>'photohistories'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Информация о нас',
				'url'=>array('site/page','view'=>'about'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Контакты',
				'url'=>array('site/contact'),
				'active'=>false,
				'subMenu'=>'',
			),
			array(
				'title'=>'Вакансии',
				'url'=>array('site/page','view'=>'vacancy'),
				'active'=>false,
				'subMenu'=>'',
			),
		);

		// активный раздел
		$route = $this->getController()->getRoute();
		$params = $this->getController()->getActionParams();

		if ($route=='site/index')
			$menu[0]['active'] = true;
		if ( ($route=='pages/list' || $route=='pages/view') && 
		     (isset($params['type']) && $params['type']=='countries') )
			$menu[1]['active'] = true;
		if ( ($route=='pages/list' || $route=='pages/view') && 
		     (isset($params['type']) && $params['type']=='news') )
			$menu[2]['active'] = true;
		if ( ($route=='pages/list' || $route=='pages/view') && 
		     (isset($params['type']) && $params['type']=='tourism') )
			$menu[3]['active'] = true;
		if ( $route=='site/page' && (isset($params['view']) && ($params['view']=='photohistories' || $params['view']=='ingushetiya-gory' || $params['view']=='risovye-terrasy' || $params['view']=='tseremoniya-krematsii' || $params['view']=='ilistyye-pryguny' || $params['view']=='nashi-sosedi-2' || $params['view']=='nashi-domashniye-zhivotnyye')) )
			$menu[4]['active'] = true;
		if ( $route=='site/page' && (isset($params['view']) && $params['view']=='about') )
			$menu[5]['active'] = true;
		if ( $route=='site/contact')
			$menu[6]['active'] = true;
		if ( $route=='site/page' && (isset($params['view']) && $params['view']=='vacancy') )
			$menu[7]['active'] = true;

		// ищем все страны
		$countries = array();
		$connection = Yii::app()->db;
		$sql = '
			Select P.`name`, PT.`type`, P.`id`, P.`url`
			From pr4ote_pages P
				join pr4ote_pages_types PT on P.`id_page_type` = PT.`id`
			Where PT.`type` = "countries"
			Order by P.`name`;
		';
		$command = $connection->createCommand($sql);
		$countries = $command->queryAll(true);

		// формируем страны по 5 колонкам
		$countriesCol = array();
		$cCnt = count($countries);
		if ($cCnt>0)
		{
			$div = (integer)($cCnt/5); // колличество элементов в столбце без остатка
			$rest = ($cCnt%5); // остаток

			$lim = array($div,$div,$div,$div,$div);
			for ($i=0;$i<$rest;$i++) $lim[$i]++;

			$k = 0; $j = 1; // k - коофицент обнуления, j - номер столбца и лимита
			for ($i=0;$i<$cCnt;$i++)
			{
				$countriesCol[$k][] = array(
					'id'=>$countries[$i]['id'],
					'name'=>$countries[$i]['name'],
					'type'=>$countries[$i]['type'],
					'url'=>$countries[$i]['url'],
				);
				if ($j == $lim[$k])
				{
					$j=1;
					$k++;
				}
				else $j++;
			}
			// освобождаем память
			unset ($countries,$div,$rest);
		}
		unset ($cCnt);

		$this->render('mainMenu',array(
			'menu'=>$menu,
			'countriesCol'=>$countriesCol,
		));
	}
}