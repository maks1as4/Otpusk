<?php

/**
 * This is the model class for table "{{attributes_types}}".
 *
 * The followings are the available columns in table '{{attributes_types}}':
 * @property string $id
 * @property integer $id_page_type
 * @property string $translit
 * @property string $name
 * @property string $description
 * @property integer $type
 */
class AttributesTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attributes_types}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_page_type, translit, name', 'required'),
			array('id_page_type, type', 'numerical', 'integerOnly'=>true),
			array('translit, name', 'length', 'max'=>255),
			array('translit', 'unique'),
			array('translit', 'match', 'pattern'=>'/^([a-z0-9\_]+)$/u', 'message'=>'Недопустимые символы, разрешено a-z0-9_'),
			array('description', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page_type, name, type', 'safe', 'on'=>'search'),
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
			'pageType'=>array(self::BELONGS_TO,'PagesTypes','id_page_type'),
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
			'translit' => 'Машинное наименование (англ.)',
			'name' => 'Наименование',
			'description' => 'Описание',
			'type' => 'Тип переменной',
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
		$criteria->compare('id_page_type',$this->id_page_type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admAtTypesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'id desc',
			),
		));
	}

	public function beforeSave()
	{
		$this->name = Functions::upperFirst($this->name);
		return parent::beforeSave();
	}

	protected function beforeDelete()
	{
		Attributes::model()->deleteAll('id_attribute_type=:id',array(':id'=>$this->id));
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

	public static function getAllTypes()
	{
		return array(0=>'string',1=>'text',2=>'link',3=>'option',4=>'image',5=>'file',6=>'date');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttributesTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
