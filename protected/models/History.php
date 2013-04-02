<?php

/**
 * This is the model class for table "History".
 *
 * The followings are the available columns in table 'History':
 * @property string $Type
 * @property string $TableName
 * @property string $PrimaryKey
 * @property string $FieldName
 * @property string $InitialValue
 * @property string $NewValue
 * @property integer $UserId
 * @property string $IpAddress
 * @property string $ChangeTime
 */
class History extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return History the static model class
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
		return 'History';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Type, TableName, PrimaryKey, UserId, IpAddress, ChangeTime', 'required'),
			array('UserId', 'numerical', 'integerOnly'=>true),
			array('Type', 'length', 'max'=>6),
			array('TableName, PrimaryKey, FieldName', 'length', 'max'=>30),
			array('IpAddress', 'length', 'max'=>20),
			array('InitialValue, NewValue', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Type, TableName, PrimaryKey, FieldName, InitialValue, NewValue, UserId, IpAddress, ChangeTime', 'safe', 'on'=>'search'),
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
			'Type' => 'Type',
			'TableName' => 'Table Name',
			'PrimaryKey' => 'Primary Key',
			'FieldName' => 'Field Name',
			'InitialValue' => 'Initial Value',
			'NewValue' => 'New Value',
			'UserId' => 'User',
			'IpAddress' => 'Ip Address',
			'ChangeTime' => 'Change Time',
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

		$criteria->compare('Type',$this->Type,true);

		$criteria->compare('TableName',$this->TableName,true);

		$criteria->compare('PrimaryKey',$this->PrimaryKey,true);

		$criteria->compare('FieldName',$this->FieldName,true);

		$criteria->compare('InitialValue',$this->InitialValue,true);

		$criteria->compare('NewValue',$this->NewValue,true);

		$criteria->compare('UserId',$this->UserId);

		$criteria->compare('IpAddress',$this->IpAddress,true);

		$criteria->compare('ChangeTime',$this->ChangeTime,true);

		return new CActiveDataProvider('History', array(
			'criteria'=>$criteria,
		));
	}
}