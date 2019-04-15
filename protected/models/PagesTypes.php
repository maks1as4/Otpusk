<?php

/**
 * This is the model class for table "{{pages_types}}".
 *
 * The followings are the available columns in table '{{pages_types}}':
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property string $seo_title
 * @property string $seo_decryption
 * @property string $seo_keywords
 * @property integer $img_mini_t
 * @property integer $img_mini_w
 * @property integer $img_mini_h
 * @property integer $img_small_t
 * @property integer $img_small_w
 * @property integer $img_small_h
 * @property integer $img_medium_t
 * @property integer $img_medium_w
 * @property integer $img_medium_h
 * @property integer $img_big_t
 * @property integer $img_big_w
 * @property integer $img_big_h
 * @property integer $img_large_t
 * @property integer $img_large_w
 * @property integer $img_large_h
 * @property string $img_bg_color
 * @property integer $content_required
 * @property integer $comments
 * @property integer $pager
 */
class PagesTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pages_types}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, name', 'required'),
			array('type, name', 'length', 'min'=>2, 'max'=>255),
			array('description', 'length', 'max'=>1024),
			array('type', 'unique'),
			array('type', 'match', 'pattern'=>'/^([a-z0-9-]+)$/u', 'message'=>'Недопустимые символы, разрешено a-z0-9-'),
			array('name', 'match', 'pattern'=>'/^([а-яa-z0-9-_\s]+)$/ui', 'message'=>'Недопустимые символы, разрешено а-я a-z 0-9 -_.,'),
			array('seo_title, seo_decryption, seo_keywords', 'length', 'max'=>150),
			array('img_mini_t, img_small_t, img_medium_t, img_big_t, img_large_t, content_required, comments', 'numerical', 'integerOnly'=>true),
			array('img_mini_w, img_mini_h, img_small_w, img_small_h, img_medium_w, img_medium_h, img_big_w, img_big_h, img_large_w, img_large_h', 'numerical', 'min'=>0, 'max'=>1500, 'integerOnly'=>true, 'allowEmpty'=>true),
			array('pager', 'numerical', 'min'=>0, 'max'=>1000, 'integerOnly'=>true, 'allowEmpty'=>true),
			array('img_bg_color', 'rgb'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, name, comments', 'safe', 'on'=>'search'),
		);
	}

	public function rgb($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if (!empty($this->img_bg_color))
			{
				if (preg_match("/^\d{1,3},\d{1,3},\d{1,3}$/",$this->img_bg_color))
				{
					preg_match("/^(\d{1,3}),(\d{1,3}),(\d{1,3})$/",$this->img_bg_color,$color);
					for ($i=1; $i<4; $i++)
						if ($color[$i] > 255)
							$this->addError($attribute,'Формат не соотверствует требованию RGB (255,255,255).');
				}
				else
					$this->addError($attribute,'Формат не соотверствует требованию RGB (255,255,255).');
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'type' => 'Машинное наименование (англ.)',
			'name' => 'Наименование типа страниц',
			'description' => 'Краткое описание',
			'seo_title' => 'Title (Seo)',
			'seo_decryption' => 'Decryption (Seo)',
			'seo_keywords' => 'Keywords (Seo)',
			'img_mini_t' => 'Тип картинки mini',
			'img_mini_w' => 'Ширина картинки mini',
			'img_mini_h' => 'Высота картинки mini',
			'img_small_t' => 'Тип картинки small',
			'img_small_w' => 'Ширина картинки small',
			'img_small_h' => 'Высота картинки small',
			'img_medium_t' => 'Тип картинки medium',
			'img_medium_w' => 'Ширина картинки medium',
			'img_medium_h' => 'Высота картинки medium',
			'img_big_t' => 'Тип картинки big',
			'img_big_w' => 'Ширина картинки big',
			'img_big_h' => 'Высота картинки big',
			'img_large_t' => 'Тип картинки large',
			'img_large_w' => 'Ширина картинки large',
			'img_large_h' => 'Высота картинки large',
			'img_bg_color' => 'Цвет бекграунда картинок (RGB)',
			'content_required' => 'Заполнение контента',
			'comments' => 'Комментарии для страниц',
			'pager' => 'Элементов на странице',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comments',$this->comments);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admPagesTypesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'id desc',
			),
		));
	}

	public function beforeSave()
	{
		$this->name = Functions::upperFirst($this->name);
		if ($this->img_mini_t=='0')
		{
			$this->img_mini_w = 0;
			$this->img_mini_h = 0;
		}
		if ($this->img_small_t=='0')
		{
			$this->img_small_w = 0;
			$this->img_small_h = 0;
		}
		if ($this->img_medium_t=='0')
		{
			$this->img_medium_w = 0;
			$this->img_medium_h = 0;
		}
		if ($this->img_big_t=='0')
		{
			$this->img_big_w = 0;
			$this->img_big_h = 0;
		}
		if ($this->img_large_t=='0')
		{
			$this->img_large_w = 0;
			$this->img_large_h = 0;
		}
		if (empty($this->img_mini_w)) $this->img_mini_w = 0;
		if (empty($this->img_mini_h)) $this->img_mini_h = 0;
		if (empty($this->img_small_w)) $this->img_small_w = 0;
		if (empty($this->img_small_h)) $this->img_small_h = 0;
		if (empty($this->img_medium_w)) $this->img_medium_w = 0;
		if (empty($this->img_medium_h)) $this->img_medium_h = 0;
		if (empty($this->img_big_w)) $this->img_big_w = 0;
		if (empty($this->img_big_h)) $this->img_big_h = 0;
		if (empty($this->img_large_w)) $this->img_large_w = 0;
		if (empty($this->img_large_h)) $this->img_large_h = 0;
		if (empty($this->img_bg_color)) $this->img_bg_color = '255,255,255';
		if (empty($this->pager)) $this->pager = 0;
		return parent::beforeSave();
	}

	protected function beforeDelete()
	{
		$pId = $atId = array();
		// удаляем все связанные страницы и запоминаем id удаленных страниц
		$pages = Pages::model()->findAll('id_page_type=:id',array(':id'=>$this->id));
		foreach ($pages as $page)
		{
			$pId[] = $page->id;
			$page->delete();
		}
		// удаляем атрибуты связанные с удаленными страницами
		foreach ($pId as $id)
		{
			Attributes::model()->deleteByPk($id);
			// удаляем картинки страницы
			$images = PagesImages::model()->findAll('id_page=:id',array(':id'=>$id));
			if (!empty($images))
				foreach ($images as $image)
					Functions::deleteImages($image->image,$image->ext);
			PagesImages::model()->deleteByPk($id);
		}
		unset($pId);
		// удаляем все связанные типы атрибутов и запоминаем id
		$atypes = AttributesTypes::model()->findAll('id_page_type=:id',array(':id'=>$this->id));
		foreach ($atypes as $type)
		{
			$atId[] = $type->id;
			$type->delete();
		}
		// удаляем атрибуты связанные с удаленными типами атрибутов
		foreach ($atId as $id)
			Attributes::model()->deleteByPk($id);
		unset($atId);
		return parent::beforeDelete();
	}

	public static function getList()
	{
		$models = self::model()->findAll();
		return CHtml::listData($models,'id','name');
	}

	public static function getStrictList()
	{
		$models = self::model()->findAll();
		$a = array();
		foreach ($models as $model)
			$a['='.$model->id] = $model->name;
		return $a;
	}

	public static function getImagesPreset($id)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'img_mini_t, img_mini_w, img_mini_h, img_small_t, img_small_w, img_small_h, img_medium_t, img_medium_w, img_medium_h, img_big_t, img_big_w, img_big_h, img_large_t, img_large_w, img_large_h, img_bg_color';
		$criteria->condition = 'id=:id_type';
		$criteria->params = array(':id_type'=>$id);
		return self::model()->find($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PagesTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
