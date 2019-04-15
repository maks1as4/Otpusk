<?php

class RecentPages extends CWidget
{
	public $title = '';
	public $render;
	public $type;
	public $limit = 3;
	public $order = 'p.adate desc';

	public function run()
	{
		// если не заданно отображение для блока или тип страниц, то выход
		if (empty($this->type) || empty($this->render)) return false;

		// лимит должен быть положительным числом
		if ($this->limit <= 0) return false;

		// проверяем наличие фаил рендеринга, если нет, то выход
		$findRender = Yii::getPathOfAlias('webroot.protected.components.views').DIRECTORY_SEPARATOR.
					  $this->render.'.php';
		if (!is_file($findRender)) return false;

		// ищем страницы
		$connection = Yii::app()->db;
		$connection->enableParamLogging = true;
		$sql = '
			Select p.id, pt.id as ptid, pt.type, p.name, p.url, p.content, p.adate, p.udate, pim.image, pim.ext, pim.alt
			From {{pages}} p
				join {{pages_types}} pt on p.id_page_type = pt.id
				left join {{pages_images}} pim on p.id = pim.id_page
			Where pt.`type`=:pt and p.visibility=1
			Group by p.id
			Order by '.$this->order.'
			Limit :limit
		';
		$command = $connection->createCommand($sql);
		$command->bindParam(':pt',$this->type,PDO::PARAM_STR);
		$command->bindParam(':limit',$this->limit,PDO::PARAM_INT);
		$pages = $command->queryAll(true);

		// если данные по запросу не найдены, то выход
		if (empty($pages)) return false;

		$this->render($this->render,array(
			'pages'=>$pages,
		));
	}

	// загрузить все атрибуты страницы в виде массива
	public function getAttributesArray($id)
	{
		$a = array();
		$model = Attributes::model()->findAll('id_page=:pid',array(':pid'=>$id));
		if (!empty($model))
		{
			foreach ($model as $m)
			{
				$a[$m->attributeType->translit] = array(
					'name'=>$m->attributeType->name,
					'value'=>$m->value,
					'type'=>$m->attributeType->type,
				);
			}
		}
		return $a;
	}
}