<?php

/**
 * This is the model class for table "{{pages_images}}".
 *
 * The followings are the available columns in table '{{pages_images}}':
 * @property string $id
 * @property string $id_page
 * @property string $image
 * @property string $ext
 * @property string $alt
 */
class PagesImages extends CActiveRecord
{
	const IMAGES_DIR = 'webroot.storage.images.pages';
	public $image;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{pages_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_page', 'required'),
			array('id_page', 'length', 'max'=>11),
			array('image', 'length', 'max'=>50),
			array('image', 'file', 'types'=>'png,jpg,jpeg,gif', 'allowEmpty'=>false, 'maxSize'=>1024*1024*2, 'tooLarge'=>'Картинка слишком большая, разрешенно не более 2MB.', 'minSize'=>512, 'tooSmall'=>'Картинка слишком маленькая, разрешенно не менее 512 byte.', 'on'=>'create'),
			array('image', 'file', 'types'=>'png,jpg,jpeg,gif', 'allowEmpty'=>true, 'maxSize'=>1024*1024*2, 'tooLarge'=>'Картинка слишком большая, разрешенно не более 2MB.', 'minSize'=>512, 'tooSmall'=>'Картинка слишком маленькая, разрешенно не менее 512 byte.', 'on'=>'update'),
			array('ext', 'length', 'max'=>5),
			array('alt', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page, image, ext, alt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'page'=>array(self::BELONGS_TO,'Pages','id_page'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'id_page' => 'Страница',
			'image' => 'Картинка',
			'ext' => 'Расширение',
			'alt' => 'Описание картинки',
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
		$criteria->compare('id_page',$this->id_page,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('alt',$this->alt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admImagesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'id desc',
			),
		));
	}

	public function beforeSave()
	{
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
			$preset = PagesTypes::getImagesPreset($this->page->id_page_type); // загружаем настройки пресетов
			// создание пресетов
			$imagesQuality = 95;
			$ih = new CImageHandler();
			$ih->load($this->getImgPath().$fileName.'.'.$extension);
			// картинка Thumb
			$ih->adaptiveThumb(Yii::app()->params['imgPreset']['thumbWidth'],Yii::app()->params['imgPreset']['thumbHeight'])->save($this->getImgPath().$fileName.'_thumb.'.$extension,false,$imagesQuality)->reload();
			// картинка Mini
			if ($preset->img_mini_t!='0' && $preset->img_mini_w!='0' && $preset->img_mini_h!='0')
			{
				switch ($preset->img_mini_t)
				{
					case '1':
					{
						$ih->thumb($preset->img_mini_w,$preset->img_mini_h)->save($this->getImgPath().$fileName.'_mini.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '2':
					{
						$ih->adaptiveThumb($preset->img_mini_w,$preset->img_mini_h)->save($this->getImgPath().$fileName.'_mini.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '3':
					{
						$ih->resize($preset->img_mini_w,$preset->img_mini_h,false)->save($this->getImgPath().$fileName.'_mini.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '4':
					{
						$colors = explode(',',$preset->img_bg_color);
						$ih->resizeCanvas($preset->img_mini_w,$preset->img_mini_h,array($colors[0],$colors[1],$colors[2]))->save($this->getImgPath().$fileName.'_mini.'.$extension,false,$imagesQuality)->reload();
						break;
					}
				}
			}
			// картинка Small
			if ($preset->img_small_t!='0' && $preset->img_small_w!='0' && $preset->img_small_h!='0')
			{
				switch ($preset->img_small_t)
				{
					case '1':
					{
						$ih->thumb($preset->img_small_w,$preset->img_small_h)->save($this->getImgPath().$fileName.'_small.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '2':
					{
						$ih->adaptiveThumb($preset->img_small_w,$preset->img_small_h)->save($this->getImgPath().$fileName.'_small.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '3':
					{
						$ih->resize($preset->img_small_w,$preset->img_small_h,false)->save($this->getImgPath().$fileName.'_small.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '4':
					{
						$colors = explode(',',$preset->img_bg_color);
						$ih->resizeCanvas($preset->img_small_w,$preset->img_small_h,array($colors[0],$colors[1],$colors[2]))->save($this->getImgPath().$fileName.'_small.'.$extension,false,$imagesQuality)->reload();
						break;
					}
				}
			}
			// картинка Medium
			if ($preset->img_medium_t!='0' && $preset->img_medium_w!='0' && $preset->img_medium_h!='0')
			{
				switch ($preset->img_medium_t)
				{
					case '1':
					{
						$ih->thumb($preset->img_medium_w,$preset->img_medium_h)->save($this->getImgPath().$fileName.'_medium.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '2':
					{
						$ih->adaptiveThumb($preset->img_medium_w,$preset->img_medium_h)->save($this->getImgPath().$fileName.'_medium.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '3':
					{
						$ih->resize($preset->img_medium_w,$preset->img_medium_h,false)->save($this->getImgPath().$fileName.'_medium.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '4':
					{
						$colors = explode(',',$preset->img_bg_color);
						$ih->resizeCanvas($preset->img_medium_w,$preset->img_medium_h,array($colors[0],$colors[1],$colors[2]))->save($this->getImgPath().$fileName.'_medium.'.$extension,false,$imagesQuality)->reload();
						break;
					}
				}
			}
			// картинка Big
			if ($preset->img_big_t!='0' && $preset->img_big_w!='0' && $preset->img_big_h!='0')
			{
				switch ($preset->img_big_t)
				{
					case '1':
					{
						$ih->thumb($preset->img_big_w,$preset->img_big_h)->save($this->getImgPath().$fileName.'_big.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '2':
					{
						$ih->adaptiveThumb($preset->img_big_w,$preset->img_big_h)->save($this->getImgPath().$fileName.'_big.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '3':
					{
						$ih->resize($preset->img_big_w,$preset->img_big_h,false)->save($this->getImgPath().$fileName.'_big.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '4':
					{
						$colors = explode(',',$preset->img_bg_color);
						$ih->resizeCanvas($preset->img_big_w,$preset->img_big_h,array($colors[0],$colors[1],$colors[2]))->save($this->getImgPath().$fileName.'_big.'.$extension,false,$imagesQuality)->reload();
						break;
					}
				}
			}
			// картинка Large
			if ($preset->img_large_t!='0' && $preset->img_large_w!='0' && $preset->img_large_h!='0')
			{
				switch ($preset->img_large_t)
				{
					case '1':
					{
						$ih->thumb($preset->img_large_w,$preset->img_large_h)->save($this->getImgPath().$fileName.'_large.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '2':
					{
						$ih->adaptiveThumb($preset->img_large_w,$preset->img_large_h)->save($this->getImgPath().$fileName.'_large.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '3':
					{
						$ih->resize($preset->img_large_w,$preset->img_large_h,false)->save($this->getImgPath().$fileName.'_large.'.$extension,false,$imagesQuality)->reload();
						break;
					}
					case '4':
					{
						$colors = explode(',',$preset->img_bg_color);
						$ih->resizeCanvas($preset->img_large_w,$preset->img_large_h,array($colors[0],$colors[1],$colors[2]))->save($this->getImgPath().$fileName.'_large.'.$extension,false,$imagesQuality)->reload();
						break;
					}
				}
			}
			// пересохраняем оригинальную картинку
			$ih->thumb(Yii::app()->params['imgPreset']['originalWidth'],Yii::app()->params['imgPreset']['originalHeight'])->save($this->getImgPath().$fileName.'.'.$extension,false,$imagesQuality);
			// закрываем сохраненые файлы от записи
			$imagesFormats = self::getImagesFormats();
			foreach ($imagesFormats as $format)
			{
				$imagePath = $this->getImgPath().$fileName.$format.'.'.$extension;
				if (is_file($imagePath)) chmod($imagePath,0444);
			}
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
		$imagesFormats = self::getImagesFormats();
		chmod($this->getImgPath(),0777); // открываем папку для записи
		foreach ($imagesFormats as $format)
		{
			$imagePath = $this->getImgPath().$this->image.$format.'.'.$this->ext;
			if (is_file($imagePath)) unlink($imagePath);
		}
		chmod($this->getImgPath(),0555); // закрываем папку от записи
    }

	public static function getImagesTypes()
	{
		return array(0=>'не загружать',1=>'thumb',2=>'adaptiveThumb',3=>'resize',4=>'resizeCanvas');
	}

	public static function getImagesFormats()
	{
		return array('_thumb','_mini','_small','_medium','_big','_large','');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PagesImages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
