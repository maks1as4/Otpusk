<?php

/**
 * This is the model class for table "{{options}}".
 *
 * The followings are the available columns in table '{{options}}':
 * @property string $id
 * @property integer $add_comments_guest
 * @property integer $add_comments_user
 * @property integer $check_comments_guest
 * @property integer $check_comments_user
 * @property integer $check_user_registration
 */
class Options extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{options}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('add_comments_guest, add_comments_user, check_comments_guest, check_comments_user, check_user_registration', 'numerical', 'integerOnly'=>true),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'add_comments_guest' => 'Добавление комментариев гостями',
			'add_comments_user' => 'Добавление комментариев пользователями',
			'check_comments_guest' => 'Проверять комментарии добавленные гостями',
			'check_comments_user' => 'Проверять комментарии добавленные пользователями',
			'check_user_registration' => 'Проверка зарегистрированных пользователей',
		);
	}

	public static function getOptions()
	{
		return self::model()->findByPk(1);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Options the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
