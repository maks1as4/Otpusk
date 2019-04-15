<?php

class PagesController extends Controller
{
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xefeadb,
				'maxLength'=>5,
				'minLength'=>3,
				'foreColor'=>0x6f0025,
			),
		);
	}

	public function actionList($type)
	{
		// тип страниц
		$pageType = $this->getPageType($type);

		// условия выбора страниц
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_page_type=:tid and visibility=1';
		$criteria->params = array(':tid'=>$pageType->id);
		$criteria->order = 'adate desc';

		// пейджинг по страницам, не используем если 0
		if ($pageType->pager > 0)
		{
			$pager = new CPagination(Pages::model()->count($criteria));
			$pager->pageSize = $pageType->pager;
			$pager->applyLimit($criteria);
		}
		else $pager = null;

		// страницы
		$pages = Pages::model()->findAll($criteria);

		// определяем файлы для рендиринга
		$findRender = Yii::getPathOfAlias('webroot.protected.views.pages').DIRECTORY_SEPARATOR.
					  'list_'.$pageType->type.'.php';
		$renderName = is_file($findRender) ? 'list_'.$pageType->type : 'list';
		$findRender = Yii::getPathOfAlias('webroot.protected.views.pages').DIRECTORY_SEPARATOR.
					  '_list_'.$pageType->type.'.php';
		$renderPartialName = is_file($findRender) ? '_list_'.$pageType->type : '_list';
		unset ($findRender);

		$this->render($renderName,array(
			'renderPartialName'=>$renderPartialName,
			'pageType'=>$pageType,
			'pages'=>$pages,
			'pager'=>$pager,
		));
	}

	public function actionView($type,$id,$url)
	{
		// страница
		$criteria = new CDbCriteria;
		$criteria->condition = 'id=:pid and url=:purl and visibility=1';
		$criteria->params = array(':pid'=>$id,':purl'=>$url);
		$page = Pages::model()->find($criteria);

		if ($page === null)
			throw new CHttpException(404);

		if ($page->pageType->type != $type)
			throw new CHttpException(404);

		// фильтруем контент страницы
		$config = array(
			'Core.Encoding'=>'utf-8',
			'URI.Host'=>Yii::app()->getBaseUrl(true),
			'Attr.AllowedFrameTargets'=>array('_blank'),
			'Attr.AllowedRel'=>array('nofollow'),
		);
		$filter = new CHtmlPurifier();
		$filter->options = $config;
		$content = $filter->purify($page->content);

		// загружаем все картинки
		$images = $this->getImagesArray($page->id);

		// загружаем атрибуты
		$attributes = $this->getAttributesArray($page->id);

		// загружаем комментарии
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_page=:pid and status=0';
		$criteria->params = array(':pid'=>$page->id);
		$criteria->order = 'adate desc';
		$comments = Comments::model()->findAll($criteria);

		// подгружаем опции сайта
		$options = Options::getOptions();

		// форма добавления комментариев
		$commentForm = new CommentsForm;
		if (Yii::app()->user->isGuest)
			$commentForm->setScenario('isGuest');

		if(isset($_POST['ajax']) && $_POST['ajax']==='comments-add-form')
		{
			echo CActiveForm::validate($commentForm);
			Yii::app()->end();
		}

		if (isset($_POST['CommentsForm']))
		{
			$commentForm->attributes = $_POST['CommentsForm'];
			if ($commentForm->validate())
			{
				$coment = new Comments;
				$coment->setScenario('commentAdd');
				$coment->id_page = $id;
				$coment->id_user = $commentForm->id_user;
				$coment->guest = $commentForm->guest;
				$coment->comment = $commentForm->comment;
				$coment->status = 0;
				$coment->adate = date('Y-m-d H:i:s');
				$coment->udate = date('Y-m-d H:i:s');
				if ($coment->save())
				{
					if ($coment->status=='0')
						Yii::app()->user->setFlash('comentAdded','Комментарий сохранён.');
					else
						Yii::app()->user->setFlash('comentCheck','Комментарий будет отображаться после проверки модератором.');
					$this->redirect(array('view','type'=>$type,'id'=>$id,'url'=>$url,'#'=>'comments-top'));
				}
			}
		}

		// определяем файл для рендиринга
		$findRender = Yii::getPathOfAlias('webroot.protected.views.pages').DIRECTORY_SEPARATOR.
					  'view_'.$page->pageType->type.'.php';
		$renderName = is_file($findRender) ? 'view_'.$page->pageType->type : 'view';
		unset ($findRender);

		$this->render($renderName,array(
			'page'=>$page,
			'content'=>$content,
			'images'=>$images,
			'attributes'=>$attributes,
			'comments'=>$comments,
			'options'=>$options,
			'commentForm'=>$commentForm,
		));
	}

	// Загрузить тип страницы
	public function getPageType($type)
	{
		$model = PagesTypes::model()->find('type=:type',array(':type'=>$type));
		if ($model === null)
			throw new CHttpException(404);
		return $model;
	}

	// Загружаем первую картинку
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

	// Загружаем все картинки в виде массива
	public function getImagesArray($id)
	{
		$i = array();
		$criteria = new CDbCriteria;
		$criteria->condition = 'id_page=:pid';
		$criteria->params = array(':pid'=>$id);
		$criteria->order = 'id';
		$model = PagesImages::model()->findAll($criteria);
		if (!empty($model))
		{
			foreach ($model as $m)
			{
				$i[] = array(
					'image'=>$m->image,
					'ext'=>$m->ext,
					'alt'=>$m->alt,
				);
			}
		}
		return $i;
	}

	// Загрузить все атрибуты страницы
	public function getAttributes($id)
	{
		$model = Attributes::model()->findAll('id_page=:pid',array(':pid'=>$id));
		return $model;
	}

	// Загрузить все атрибуты страницы в виде массива
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