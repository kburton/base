<?php

/**
 * This is the model class for table "VerificationCode".
 *
 * The followings are the available columns in table 'VerificationCode':
 * @property integer $Id
 * @property string $ForeignTableId
 * @property string $Type
 * @property integer $UserId
 * @property string $VerificationCode
 * @property string $Created
 * @property string $Expires
 * @property integer $Active
 */
class VerificationCode extends CActiveRecord
{
	public $expired;	// Set using beforeFind method.
	private $_expiresInHours = 24;	// Default expiry in 24 hours after creation time.
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return VerificationCode the static model class
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
		return 'VerificationCode';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ForeignTableId, Type, UserId', 'required'),
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

	public function setExpiresInHours($value)
	{
		$this->_expiresInHours = $value;
	}
	
	/**
	 * Generates a random verification code consisting of numbers and letters.
	 * @param int $length the output code length. Defaults to 20.
	 * @return string the random code.
	 */
	public static function generateVerificationCode($length = 20)
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$maxIndex = strlen($chars) - 1;
		$result = '';
		for ($i = 0; $i < $length; $i++)
			$result .= $chars[mt_rand(0, $maxIndex)];
		return $result;
	}
	
	/**
	 * Deactivates codes which are no longer required as the action has been performed.
	 * @param string $type the type of the code
	 * @param string $foreignTableId the Id of the foreign table to which the code applies
	 * @param integer $userId the user to whom the code was assigned
	 * @return integer the number of records updated
	 */
	public static function deactivateCodes($type, $foreignTableId, $userId)
	{
		$criteria = new CDbCriteria;
		$criteria->addColumnCondition(array('ForeignTableId'=>$foreignTableId, 'Type'=>$type, 'UserId'=>$userId, 'Active'=>1));
		return VerificationCode::model()->updateAll(array('Active'=>0), $criteria);
	}

	/**
	 * Populate the expired field by comparing Expires with NOW() in db.
	 */
	public function beforeFind()
	{
		$this->dbCriteria->select .= ', NOW() > Expires AS expired';
	}
	
	/**
	 * Generate a new verification code and calculate Expires when inserting record.
	 */
	public function beforeSave()
	{
		if (parent::beforeSave())
		{
			$this->VerificationCode = self::generateVerificationCode();
			$this->Expires = new CDbExpression('DATE_ADD(NOW(), INTERVAL :hours HOUR)', array(':hours'=>$this->_expiresInHours));
			return true;
		}
		return false;
	}

	public static function checkCode($type, $verificationId, $verificationCode, $foreignTableId = null, $userId = null)
	{
		$record = VerificationCode::model()->findByPk($verificationId);

		if ($record === null)
			throw new Exception('Verification record not found.');

		if ($type !== $record->Type)
			throw new Exception('Invalid credentials.');

		if ($verificationCode !== $record->VerificationCode)
			throw new Exception('Invalid credentials.');

		if ($userId !== null && $userId !== $record->UserId)
			throw new Exception('Invalid credentials.');

		if ($foreignTableId !== null && $foreignTableId !== $record->ForeignTableId)
			throw new Exception('Invalid credentials.');

		if (!$record->Active || $record->expired)
			throw new Exception('This verification code has expired. Please request a new one.');
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'Id',
			'ForeignTableId' => 'Foreign Table',
			'Type' => 'Type',
			'UserId' => 'User',
			'VerificationCode' => 'Verification Code',
			'Created' => 'Created',
			'Expires' => 'Expires',
			'Active' => 'Active',
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

		$criteria->compare('ForeignTableId',$this->ForeignTableId,true);

		$criteria->compare('Type',$this->Type,true);

		$criteria->compare('UserId',$this->UserId);

		$criteria->compare('VerificationCode',$this->VerificationCode,true);

		$criteria->compare('Created',$this->Created,true);

		$criteria->compare('Expires',$this->Expires,true);

		$criteria->compare('Active',$this->Active);

		return new CActiveDataProvider('VerificationCode', array(
			'criteria'=>$criteria,
		));
	}
}