<?php

class ResetPasswordForm extends CFormModel
{
	public $user;
	public $verifid;
	public $verifcode;
	public $password;
	public $passwordRepeat;

	private $_passwordVerifier;

	public function __construct($userid, $verifid, $verifcode)
	{
		parent::__construct('');

		$this->user = User::model()->findByPk($userid);
		$this->verifid = $verifid;
		$this->verifcode = $verifcode;

		$this->checkRequestCredentials();
	}

	private function checkRequestCredentials()
	{
		if (!$this->user)
			throw new Exception(Yii::t('user', 'user_id_not_recognised'));

		$this->user->checkAccountAccess();
		
		VerificationCode::checkCode('password_reset', $this->verifid, $this->verifcode,
			$this->user->Id, $this->user->Id);
	}

	public function rules()
	{
		return array(
			array('password, passwordRepeat', 'required'),
			array('password', 'checkPasswordRequirements', 'skipOnError'=>true),
			array('passwordRepeat', 'compare', 'compareAttribute'=>'password', 'skipOnError'=>true),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'password'=>'New Password',
			'passwordRepeat'=>'Repeat New Password',
		);
	}

	private function getPasswordVerifier()
	{
		if ($this->_passwordVerifier === null)
			$this->_passwordVerifier = new Password($this->password, $this->user->Email);
		
		return $this->_passwordVerifier;
	}

	public function checkPasswordRequirements($attribute, $params)
	{
		if (!$this->getPasswordVerifier()->isValid())
			$this->addError('password', $this->getPasswordVerifier()->getErrorMessage());
	}

	public function processPasswordReset()
	{
		$this->user->Password = $this->getPasswordVerifier()->getHash();
		$this->user->save(false, array('Password'));
	}
}
