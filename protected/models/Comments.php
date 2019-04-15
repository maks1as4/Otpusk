<?php

/**
 * This is the model class for table "{{comments}}".
 *
 * The followings are the available columns in table '{{comments}}':
 * @property string $id
 * @property string $id_page
 * @property string $id_user
 * @property string $guest
 * @property string $comment
 * @property integer $status
 * @property string $adate
 * @property string $udate
 */
class Comments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{comments}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_page, comment', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('id_page, id_user', 'length', 'max'=>11),
			array('comment', 'length', 'max'=>5000),
			array('guest', 'required', 'on'=>'isGuest'),
			array('guest', 'length', 'max'=>255),
			array('guest', 'match', 'pattern'=>'/^([a-zа-яё0-9\s-_.]+)$/ui', 'message'=>'Недопустимые символы, разрешено a-z а-я 0-9 -_ .'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_page, id_user, guest, status, adate, udate', 'safe', 'on'=>'search'),
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
			'id_page' => 'Страница',
			'id_user' => 'Автор',
			'guest' => 'Имя гостя',
			'comment' => 'Коментарий',
			'status' => 'Статус',
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
		$criteria->compare('id_page',$this->id_page,true);
		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('guest',$this->guest,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('adate',$this->adate,true);
		$criteria->compare('udate',$this->udate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admCommentsPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'udate desc',
			),
		));
	}

	public function beforeSave()
	{
		$this->udate = date('Y-m-d H:i:s');
		if ($this->isNewRecord)
		{
			$this->id_user = (isset(Yii::app()->user->id)) ? Yii::app()->user->id : 0;
			$this->adate = date('Y-m-d H:i:s');
		}
		else
		{
			if ($this->id_user!='0')
				$this->guest = '';
			else
				if ($this->guest=='') $this->guest = 'Гость';
		}
		if ($this->scenario == 'commentAdd')
		{
		
			$options = Options::getOptions();
			if (Yii::app()->user->isGuest)
			{
				if ($options->check_comments_user=='0')
				{
					$this->status = ($options->check_comments_guest=='1') ? 1 : 0;
				}
				else
					$this->status = 1;
			}
			else
			{
				if ($options->check_comments_user=='1')
				{
					$this->status = (Yii::app()->user->checkAccess(Users::ROLE_ADMIN) || Yii::app()->user->checkAccess(Users::ROLE_MODER)) ? 0 : 1;
				}
				else
					$this->status = 0;
			}
		}
		else
			if (empty($this->status)) $this->status = 0;
		return parent::beforeSave();
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

	public static function getStatus($status)
	{
		switch ($status)
		{
			case '0': return 'проверен'; break;
			case '1': return 'на проверке'; break;
			case '2': return 'скрыт'; break;
		}
	}

	public static function getAllStatus()
	{
		return array(0=>'проверен',1=>'на проверке',2=>'скрыт');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
