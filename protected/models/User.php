<?php

/**
 * This is the model class for table "User".
 *
 * The followings are the available columns in table 'User':
 * @property integer $Id
 * @property string $Title
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property string $Password
 * @property string $Status
 * @property string $RegistrationDate
 * @property string $LastSuccessfulLogin
 * @property integer $FailedLoginAttempts
 * @property integer $IsAdmin
 */
class User extends CActiveRecord
{
	private static $validTitles = array(
		'Mr.'=>'Mr.',
		'Mrs.'=>'Mrs.',
		'Miss'=>'Miss',
		'Ms.'=>'Ms.',
	);
	
	private static $validStatuses = array(
		'active'=>'Active',
		'inactive'=>'Inactive',
	);
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'User';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Title, FirstName, LastName, Email, Status, IsAdmin', 'required'),
			array('FailedLoginAttempts, IsAdmin', 'numerical', 'integerOnly'=>true),
			array('Title', 'in', 'range'=>array_keys(self::$validTitles)),
			array('FirstName, LastName', 'length', 'max'=>50),
			array('Email', 'length', 'max'=>80),
			array('Email', 'email'),
			array('Email', 'unique'),
			array('Password', 'length', 'max'=>128),
			array('Status', 'in', 'range'=>array_keys(self::$validStatuses)),
			array('LastSuccessfulLogin', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Title, FirstName, LastName, Email, Password, Status, RegistrationDate, LastSuccessfulLogin, FailedLoginAttempts, IsAdmin', 'safe', 'on'=>'search'),
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

	public function behaviors()
	{
		return array(
			'ActiveRecordHistoryLogger'
				=> 'application.models.behaviors.ActiveRecordHistoryLogger',
		);
	}
	
	public static function getTitleOptions()
	{
		return self::$validTitles;
	}
	
	public static function getStatusOptions()
	{
		return self::$validStatuses;
	}
	
	public function getStatusForDisplay()
	{
		$statusOptions = self::getStatusOptions();
		
		return isset($statusOptions[$this->Status]) ? $statusOptions[$this->Status] : '';
	}
	
	public static function getIsAdminOptions()
	{
		return array('1'=>'Yes', '0'=>'No');
	}
	
	public function getIsAdminForDisplay()
	{
		return $this->IsAdmin ? 'Yes' : 'No';
	}
	
	public function getFullName()
	{
		return $this->Title . ' ' . $this->FirstName . ' ' . $this->LastName;
	}

	/**
	 * Determines whether account status is 'active'.
	 * @return boolean
	 */
	public function isActive()
	{
		return $this->Status === 'active';
	}

	/**
	 * Determines whether user has had too many consecutive failed logins.
	 * @return boolean
	 */
	public function tooManyFailedLogins()
	{
		return $this->FailedLoginAttempts >
			Yii::app()->params['authentication']['accountLocking']['failedLogins'];
	}

	/**
	 * Throws an exception with a message if the user cannot be granted access
	 * for any reason.
	 */
	public function checkAccountAccess()
	{
		if (!$this->isActive())
			throw new Exception(Yii::t('user', 'account_no_longer_active'));

		if ($this->tooManyFailedLogins())
			throw new Exception(Yii::t('user', 'account_locked_failed_logins'));
	}

	/**
	 * Determines whether the user should be allowed to access their account (log in).
	 * @return boolean True if allowed, false otherwise.
	 */
	public function allowAccountAccess()
	{
		try
		{
			$this->checkAccountAccess();
		}
		catch (Exception $ex)
		{
			return false;
		}
		return true;
	}

	public function registerFailedLogin()
	{
		$this->FailedLoginAttempts++;
		$this->save(false, array('FailedLoginAttempts'));
	}

	public function registerSuccessfulLogin()
	{
		$this->FailedLoginAttempts = 0;
		$this->LastSuccessfulLogin = new CDbExpression('NOW()');
		$this->save(false, array('FailedLoginAttempts', 'LastSuccessfulLogin'));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'Id',
			'Title' => 'Title',
			'FirstName' => 'First Name',
			'LastName' => 'Last Name',
			'Email' => 'Email',
			'Password' => 'Password',
			'Status' => 'Status',
			'RegistrationDate' => 'Registration Date',
			'LastSuccessfulLogin' => 'Last Successful Login',
			'FailedLoginAttempts' => 'Failed Login Attempts',
			'IsAdmin' => 'Is Admin',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('Id',$this->Id);

		$criteria->compare('Title',$this->Title);

		$criteria->compare('FirstName',$this->FirstName,true);

		$criteria->compare('LastName',$this->LastName,true);

		$criteria->compare('Email',$this->Email,true);

		$criteria->compare('Password',$this->Password,true);

		$criteria->compare('Status',$this->Status);

		$criteria->compare('RegistrationDate',$this->RegistrationDate,true);

		$criteria->compare('LastSuccessfulLogin',$this->LastSuccessfulLogin,true);

		$criteria->compare('FailedLoginAttempts',$this->FailedLoginAttempts);

		$criteria->compare('IsAdmin',$this->IsAdmin);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}
}