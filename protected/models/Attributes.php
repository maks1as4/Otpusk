<?php

/**
 * This is the model class for table "{{attributes}}".
 *
 * The followings are the available columns in table '{{attributes}}':
 * @property string $id
 * @property integer $id_attribute_type
 * @property integer $id_page
 * @property string $value
 */
class Attributes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attributes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_attribute_type, id_page, value', 'required'),
			array('id_attribute_type, id_page', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>3072),
			array('id_page', 'noduplicate'),
			array('id_page', 'accord'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_attribute_type, id_page, value', 'safe', 'on'=>'search'),
		);
	}

	public function noduplicate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if ($this->isNewRecord)
			{
				if ($this->model()->exists('id_attribute_type=:atid and id_page=:pid',array(':atid'=>$this->id_attribute_type,':pid'=>$this->id_page)))
					$this->addError($attribute,'Невозможно создать дубликат.');
			}
			else
			{
				$model = $this->model()->find('id_attribute_type=:atid and id_page=:pid',array(':atid'=>$this->id_attribute_type,':pid'=>$this->id_page));
				if (!empty($model) && ($this->id!=$model->id))
				{
					if ($this->model()->exists('id_attribute_type=:atid and id_page=:pid',array(':atid'=>$this->id_attribute_type,':pid'=>$this->id_page)))
						$this->addError($attribute,'Невозможно создать дубликат.');
				}
			}
		}
	}

	public function accord($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$model1 = AttributesTypes::model()->findByPk($this->id_attribute_type);
			$model2 = Pages::model()->findByPk($this->id_page);
			if ($model1->id_page_type != $model2->id_page_type)
				$this->addError($attribute,'Данный тип артибуты не связан с выбранной страницей');
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
			'attributeType'=>array(self::BELONGS_TO,'AttributesTypes','id_attribute_type'),
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
			'id_attribute_type' => 'Тип атрибуты',
			'id_page' => 'Страница',
			'value' => 'Значение',
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
		$criteria->compare('id_attribute_type',$this->id_attribute_type);
		$criteria->compare('id_page',$this->id_page);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admAttributesPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'id desc',
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Attributes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
