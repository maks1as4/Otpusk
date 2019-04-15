<?php

class RandomPages extends CWidget
{
	public $title = '';
	public $render;
	public $type;
	public $limit = 1;

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

		// формируем условие отбора
		$where = '';
		foreach ($this->type as $type)
			$where .= 'PT.`type`="'.$type.'" or ';
		$where = substr($where,0,-4);

		if ($where == '') return false;

		// получаем идентификаторы страниц
		$conn = Yii::app()->db;
		$sql = '
			Select P.`id`
			From `pr4ote_pages` P
				join `pr4ote_pages_types` PT on P.`id_page_type` = PT.`id`
			Where '.$where.';
		';
		$model = $conn->createCommand($sql)->queryAll(false);

		if (empty($model)) return false;

		$modelIds = array();
		foreach ($model as $id)
			$modelIds[] = $id[0];

		// перемешиваем и "режем" массив с идентификаторами
		if (count($modelIds) > $this->limit)
		{
			shuffle($modelIds);
			$modelIds = array_slice($modelIds, 0, $this->limit);
		}
		else return false;

		// ищем страницы
		$criteria = new CDbCriteria();
		$criteria->addInCondition('id', $modelIds);
		$pages = Pages::model()->findAll($criteria);

		// если данные по запросу не найдены, то выход
		if (empty($pages)) return false;

		$this->render($this->render,array(
			'pages'=>$pages,
		));
	}

	// загрузить тип страницы
	public function getPageType($id)
	{
		return PagesTypes::model()->findByPk($id);
	}

	// загружаем первую картинку
	public function getImage($id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_page=:pid';
		$criteria->params = array(':pid'=>$id);
		$criteria->limit = 1;
		$criteria->order = 'id';
		$model = PagesImages::model()->find($criteria);
		return $model;
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