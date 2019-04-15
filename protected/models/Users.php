<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $avatar
 * @property string $role
 * @property integer $status
 * @property string $adate
 */
class Users extends CActiveRecord
{
	const IMAGES_DIR = 'webroot.storage.images.avatars';
	const USERS_DIR = 'webroot.users';
	const ROLE_ADMIN = 'admin';
	const ROLE_MODER = 'moder';
    const ROLE_USER = 'user';
	public $password2;
	public $avatar;
	public $verifyCode;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('username', 'match', 'pattern'=>'/^([a-z0-9-_.]+)$/ui', 'message'=>'Недопустимые символы, разрешено a-z-_ .'),
			array('username, email', 'unique'),
			array('username', 'exceptions', 'on'=>'create, update, registration'),
			array('password', 'match', 'pattern'=>'/^([a-z0-9-_]+)$/ui', 'message'=>'Недопустимые символы, разрешено a-z-_.'),
			array('email', 'email'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username, email, avatar', 'length', 'max'=>50),
			array('password', 'length', 'min'=>3, 'max'=>20, 'on'=>'create, password, registration'),
			array('password2', 'required', 'message'=>'Повторите пароль.', 'on'=>'registration'),
			array('password2', 'length', 'min'=>3, 'max'=>20, 'on'=>'registration'),
			array('password2', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли должны совпадать.', 'on'=>'registration'),
			array('role', 'length', 'max'=>10),
			array('avatar', 'file', 'types'=>'png,jpg,jpeg,gif', 'allowEmpty'=>true, 'maxSize'=>1024*1024*2, 'tooLarge'=>'Аватар слишком большой, разрешенно не более 2MB.', 'minSize'=>512, 'tooSmall'=>'Аватар слишком маленький, разрешенно не менее 512 byte.', 'on'=>'create, update, registration, user-edit'),
			array('verifyCode', 'required', 'on'=>'registration'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'registration'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, role, status, adate', 'safe', 'on'=>'search'),
		);
	}

	public function exceptions($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$usernameExc = array('admin','administrator','moder','moderator','user','mysql');
			if (in_array($this->username,$usernameExc))
				$this->addError($attribute,'Имя пользователя зарезервировано');
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
			'username' => 'Логин',
			'password' => 'Пароль',
			'password2' => 'Повторите пароль',
			'email' => 'E-mail',
			'avatar' => 'Аватар',
			'role' => 'Роль',
			'status' => 'Статус',
			'adate' => 'Дата регистрации',
			'verifyCode' => 'Код проверки',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('adate',$this->adate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['admUsersPP'],
			),
			'sort'=>array(
				'defaultOrder'=>'adate desc',
			),
		));
	}

	public function beforeSave()
	{
		if ($this->isNewRecord)
		{
			$this->adate = date('Y-m-d H:i:s');
			if (empty($this->role)) $this->role = 'user';
			$this->password = md5(Yii::app()->params['salt'].$this->password);
			$options = Options::getOptions();
			if (Yii::app()->user->isGuest)
			{
				$this->status = ($options->check_user_registration=='1') ? 2 : 0;
			}
			else
			{
				if ($options->check_user_registration=='1')
				{
					$this->status = (Yii::app()->user->checkAccess(Users::ROLE_ADMIN)) ? 0 : 2;
				}
				else
					$this->status = 0;
			}
		}
		if ($this->scenario == 'password')
			$this->password = md5(Yii::app()->params['salt'].$this->password);
		if ($this->scenario == 'registration')
			$this->role = self::ROLE_USER;
		if ($this->scenario == 'user-edit' && $this->role == self::ROLE_USER)
			$this->role = self::ROLE_USER;
		if (($this->scenario == 'create' || $this->scenario == 'update' || $this->scenario == 'registration' || $this->scenario == 'user-edit') && ($avatar = CUploadedFile::getInstance($this,'avatar')))
		{
			$this->deleteAvatar();
			chmod($this->getImgPath(),0777); // открываем папку для записи
			$this->avatar = $avatar;
			$fileName = $this->username.'.'.$this->avatar->getExtensionName();
			$this->avatar->saveAs($this->getImgPath().$fileName);
			$this->avatar = $fileName;
			$ih = new CImageHandler();
			$ih->load($this->getImgPath().$fileName)
			->adaptiveThumb(90,90)
			->save($this->getImgPath().$fileName);
			// закрываем сохраненый файл от записи
			chmod($this->getImgPath().$fileName,0444);
			chmod($this->getImgPath(),0555); // закрываем папку от записи
		}
		return parent::beforeSave();
	}

	protected function afterSave()
	{
		$dir = Yii::getPathOfAlias(self::USERS_DIR).DIRECTORY_SEPARATOR;
		$userDir = $dir.$this->username.DIRECTORY_SEPARATOR;
		chmod($dir,0777); // открываем папку для записи
		if (!file_exists($userDir))
			mkdir($userDir,0755);
		chmod($dir,0555); // закрываем папку от записи
		parent::afterSave();
	}

	protected function beforeDelete()
	{
		Pages::model()->updateAll(array('id_user'=>0),'id_user=:id',array(':id'=>$this->id));
		Comments::model()->deleteAll('id_user=:id',array(':id'=>$this->id));
		$this->deleteAvatar();
		return parent::beforeDelete();
	}

	public function deleteAvatar()
	{
		chmod($this->getImgPath(),0777); // открываем папку для записи
		$avatarPath = $this->getImgPath().$this->avatar;
		if (is_file($avatarPath)) unlink($avatarPath);
		chmod($this->getImgPath(),0555); // закрываем папку от записи
    }

	public function getImgPath()
	{
		return Yii::getPathOfAlias(self::IMAGES_DIR).DIRECTORY_SEPARATOR;
	}

	public static function getList($withNull=false)
	{
		$models = self::model()->findAll();
		$a = array();
		if ($withNull) $a[0] = '-нет-';
		foreach ($models as $model)
			$a[$model->id] = $model->username;
		return $a;
	}

	public static function getStrictList($withNull=false)
	{
		$models = self::model()->findAll();
		$a = array();
		if ($withNull) $a['=0'] = '-нет-';
		foreach ($models as $model)
			$a['='.$model->id] = $model->username;
		return $a;
	}

	public static function getUserById($id)
	{
		$model = self::model()->findByPk($id);
		return $model;
	}

	public static function getAllRoles()
	{
		return array('user'=>'user','moder'=>'moder','admin'=>'admin');
	}

	public static function getStatus($status)
	{
		switch ($status)
		{
			case '0': return 'активен'; break;
			case '1': return 'бан'; break;
			case '2': return 'подтверждение'; break;
		}
	}

	public static function getAllStatus()
	{
		return array(0=>'активен',1=>'бан',2=>'подтверждение');
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}