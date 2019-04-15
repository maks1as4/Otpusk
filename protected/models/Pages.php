<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property string $id
 * @property string $id_page_type
 * @property string $id_user
 * @property string $name
 * @property string $url
 * @property string $content
 * @property string $seo_title
 * @property string $seo_decryption
 * @property string $seo_keywords
 * @property integer $comments
 * @property integer $visibility
 * @property string $adate
 * @property string $udate
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_page_type, name', 'required'),
			array('content', 'needRequired'),
			array('comments, visibility', 'numerical', 'integerOnly'=>true),
			array('id_page_type, id_user', 'length', 'max'=>11),
			array('name', 'length', 'max'=>255),
			array('url', 'length', 'max'=>300),
			array('seo_title, seo_decryption, seo_keywords', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page_type, id_user, name, visibility, adate, udate', 'safe', 'on'=>'search'),
		);
	}

	// в зависимости от настройки обязательности контента проверям заполнено поле или не проверяем
	public function needRequired($attribute,$params)
	{
		$pageType = PagesTypes::model()->findByPk($this->id_page_type);
		if ($pageType->content_required=='1')
		{
			if (strip_tags($this->content)=='')
				$this->addError($attribute,'Необходимо заполнить поле «Контент».');
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
			'pageType'=>array(self::BELONGS_TO,'PagesTypes','id_page_type'),
			'user'=>array(self::BELONGS_TO,'Users','id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'id_page_type' => 'Тип страницы',
			'id_user' => 'Автор',
			'name' => 'Наименование',
			'url' => 'URL',
			'content' => 'Контент',
			'seo_title' => 'Title (Seo)',
			'seo_decryption' => 'Decryption (Seo)',
			'seo_keywords' => 'Keywords (Seo)',
			'comments' => 'Комментарии',
			'visibility' => 'Отображение',
			'adate' => 'Дата создания',
			'udate' => 'Дата измениения',
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
		$criteria->compare('id_page_type',$this->id_page_type,true);
		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('comments',$this->comments);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('adate',$this->adate,true);
		$criteria->compare('udate',$this->udate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admPagesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'udate desc',
			),
		));
	}

	public function beforeSave()
	{
		$this->url = Functions::translit($this->name,50);
		$this->name = Functions::upperFirst($this->name);
		$this->udate = date('Y-m-d H:i:s');
		if ($this->isNewRecord)
		{
			$this->id_user = (isset(Yii::app()->user->id)) ? Yii::app()->user->id : 0;
			$this->adate = date('Y-m-d H:i:s');
		}
		return parent::beforeSave();
	}

	protected function beforeDelete()
	{
		Attributes::model()->deleteAll('id_page=:id',array(':id'=>$this->id));
		Comments::model()->deleteAll('id_page=:id',array(':id'=>$this->id));
		// удаляем картинки страницы
		$images = PagesImages::model()->findAll('id_page=:id',array(':id'=>$this->id));
			if (!empty($images))
				foreach ($images as $image)
					Functions::deleteImages($image->image,$image->ext);
		PagesImages::model()->deleteAll('id_page=:id',array(':id'=>$this->id));
		return parent::beforeDelete();
	}

	public static function getList()
	{
		$models = self::model()->findAll(array('order'=>'name'));
		$a = array();
		foreach ($models as $model)
			$a[$model->id] = Functions::getSubText($model->name,80,true);
		return $a;
		//return CHtml::listData($models,'id','name');
	}

	public static function getStrictList()
	{
		$models = self::model()->findAll(array('order'=>'name'));
		$a = array();
		foreach ($models as $model)
			$a['='.$model->id] = Functions::getSubText($model->name,80,true);
		return $a;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
