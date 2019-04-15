<?php

/**
 * This is the model class for table "{{slides}}".
 *
 * The followings are the available columns in table '{{slides}}':
 * @property string $id
 * @property string $image
 * @property string $ext
 * @property string $name
 * @property string $content
 * @property string $link
 * @property integer $color
 * @property integer $visibility
 * @property integer $sort_order
 */
class Slides extends CActiveRecord
{
	const IMAGES_DIR = 'webroot.storage.images.slides';
	public $image;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{slides}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image', 'length', 'max'=>50),
			array('image', 'file', 'types'=>'png,jpg,jpeg,gif', 'allowEmpty'=>false, 'maxSize'=>1024*1024*5, 'tooLarge'=>'Картинка слишком большая, разрешенно не более 5MB.', 'minSize'=>512, 'tooSmall'=>'Картинка слишком маленькая, разрешенно не менее 512 byte.', 'on'=>'create'),
			array('image', 'file', 'types'=>'png,jpg,jpeg,gif', 'allowEmpty'=>true, 'maxSize'=>1024*1024*5, 'tooLarge'=>'Картинка слишком большая, разрешенно не более 5MB.', 'minSize'=>512, 'tooSmall'=>'Картинка слишком маленькая, разрешенно не менее 512 byte.', 'on'=>'update'),
			array('ext', 'length', 'max'=>5),
			array('color, visibility', 'numerical', 'integerOnly'=>true),
			array('sort_order', 'numerical', 'min'=>0, 'max'=>10000, 'integerOnly'=>true),
			array('name, content', 'length', 'max'=>255),
			array('link', 'length', 'max'=>1000),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, visibility', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'image' => 'Картинка',
			'ext' => 'Расширение',
			'name' => 'Заголовок',
			'content' => 'Краткое описание',
			'link' => 'Ссылка',
			'color' => 'Цвет фона заголовка',
			'visibility' => 'Отображение',
			'sort_order' => 'Порядковый номер',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('visibility',$this->visibility);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admSlidesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'sort_order',
			),
		));
	}

	public function beforeSave()
	{
		if (empty($this->sort_order)) $this->sort_order = 0;
		if ($image = CUploadedFile::getInstance($this,'image'))
		{
			$this->deleteImages();
			chmod($this->getImgPath(),0777); // открываем папку для записи
			$this->image = $image;
			$fileName = date('YmdHis').rand(1000,9999);
			$extension = $this->image->getExtensionName();
			$this->image->saveAs($this->getImgPath().$fileName.'.'.$extension);
			$this->image = $fileName;
			$this->ext = $extension;
			$imagesQuality = 90;
			$ih = new CImageHandler();
			$ih->load($this->getImgPath().$fileName.'.'.$extension);
			// картинка Thumb
			$ih->adaptiveThumb(Yii::app()->params['slidePreset']['thumbWidth'],Yii::app()->params['slidePreset']['thumbHeight'])->save($this->getImgPath().$fileName.'_thumb.'.$extension,false,$imagesQuality)->reload();
			// пересохраняем оригинальную картинку
			$ih->adaptiveThumb(Yii::app()->params['slidePreset']['originalWidth'],Yii::app()->params['slidePreset']['originalHeight'])->save($this->getImgPath().$fileName.'.'.$extension,false,$imagesQuality);
			// закрываем сохраненые файлы от записи
			$imagePath = $this->getImgPath().$fileName.'_thumb.'.$extension;
			if (is_file($imagePath)) chmod($imagePath,0444);
			$imagePath = $this->getImgPath().$fileName.'.'.$extension;
			if (is_file($imagePath)) chmod($imagePath,0444);
			chmod($this->getImgPath(),0555); // закрываем папку от записи
		}
		return parent::beforeSave();
	}

	protected function beforeDelete()
	{
		$this->deleteImages();
		return parent::beforeDelete();
	}

	public function getImgPath()
	{
		return Yii::getPathOfAlias(self::IMAGES_DIR).DIRECTORY_SEPARATOR;
	}

	public function deleteImages()
	{
		chmod($this->getImgPath(),0777); // открываем папку для записи
		$imagePath = $this->getImgPath().$this->image.'_thumb.'.$this->ext;
		if (is_file($imagePath)) unlink($imagePath);
		$imagePath = $this->getImgPath().$this->image.'.'.$this->ext;
		if (is_file($imagePath)) unlink($imagePath);
		chmod($this->getImgPath(),0555); // закрываем папку от записи
    }

	public static function getBgColors()
	{
		return array(0=>'черный',1=>'белый');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Slides the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
