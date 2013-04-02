<?php

class ChangePasswordForm extends CFormModel
{
	public $user;
	public $oldPassword;
	public $newPassword;
	public $newPasswordRepeat;

	private $_oldPasswordVerifier;
	private $_newPasswordVerifier;

	public function rules()
	{
		return array(
			array('oldPassword, newPassword, newPasswordRepeat', 'required'),
			array('newPassword', 'checkPasswordRequirements', 'skipOnError'=>true),
			array('newPasswordRepeat', 'compare', 'compareAttribute'=>'newPassword', 'skipOnError'=>true),
			array('oldPassword', 'verifyOldPassword', 'skipOnError'=>true),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>'Current Password',
			'newPassword'=>'New Password',
			'newPasswordRepeat'=>'Repeat New Password',
		);
	}

	private function getOldPasswordVerifier()
	{
		if ($this->_oldPasswordVerifier === null)
			$this->_oldPasswordVerifier = new Password($this->oldPassword, $this->user->Email);
		
		return $this->_oldPasswordVerifier;
	}

	private function getNewPasswordVerifier()
	{
		if ($this->_newPasswordVerifier === null)
			$this->_newPasswordVerifier = new Password($this->newPassword, $this->user->Email);
		
		return $this->_newPasswordVerifier;
	}

	public function checkPasswordRequirements($attribute, $params)
	{
		if (!$this->getOldPasswordVerifier()->isValid())
			$this->addError('oldPassword', $this->getOldPasswordVerifier()->getErrorMessage());
		if (!$this->getNewPasswordVerifier()->isValid())
			$this->addError('newPassword', $this->getNewPasswordVerifier()->getErrorMessage());
	}
	
	public function verifyOldPassword()
	{
		if ($this->user->Password !== $this->getOldPasswordVerifier()->getHash())
			$this->addError('oldPassword', 'Your existing password was incorrect.');
	}

	public function processPasswordChange()
	{
		$this->user->Password = $this->getNewPasswordVerifier()->getHash();
		$this->user->save(false, array('Password'));
	}
}
