<?php

class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $rememberMe;

	private $_passwordVerifier;
	private $_userIdentity;

	public function rules()
	{
		return array(
			array('email, password', 'required'),
			array('email', 'email'),
			array('rememberMe', 'boolean'),
			array('password', 'checkPasswordRequirements', 'skipOnError'=>true),
			array('password', 'authenticate'),
		);
	}
	
	private function getUserIdentity()
	{
		if($this->_userIdentity === null)
			$this->_userIdentity = new UserIdentity($this->email, $this->getPasswordVerifier());
		
		return $this->_userIdentity;
	}
	
	private function getPasswordVerifier()
	{
		if ($this->_passwordVerifier === null)
			$this->_passwordVerifier = new Password($this->password, $this->email);
		
		return $this->_passwordVerifier;
	}

	public function checkPasswordRequirements($attribute, $params)
	{
		if (!$this->getPasswordVerifier()->isValid())
			$this->addError('password', $this->getPasswordVerifier()->getErrorMessage());
	}

	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if (!$this->getUserIdentity()->authenticate())
			{
				$errorCode = $this->getUserIdentity()->errorCode;

				switch ($errorCode)
				{
					case UserIdentity::ERROR_USERNAME_INVALID:
						$this->addError('email', Yii::t('user', 'email_not_registered'));
						break;
					case UserIdentity::ERROR_ACCOUNT_NOT_ACTIVE:
						$this->addError('email', Yii::t('user', 'account_no_longer_active'));
						break;
					case UserIdentity::ERROR_TOO_MANY_FAILED_LOGINS:
						$this->addError('email', Yii::t('user', 'account_locked_failed_logins'));
						break;
					case UserIdentity::ERROR_PASSWORD_INVALID:
						$this->addError('password', Yii::t('user', 'incorrect_password_provided'));
						$this->getUserIdentity()->getUser()->registerFailedLogin();
						break;
					default:
						$this->addError('email', Yii::t('user', 'failed_to_authenticate'));
				}
			}
		}
	}

	public function processLogin()
	{
		$userIdentity = $this->getUserIdentity();
		$user = $userIdentity->getUser();
		$user->registerSuccessfulLogin();
		$duration = $this->rememberMe
				  ? Yii::app()->params['authentication']['rememberMe']['duration']
				  : 0;

		Yii::app()->user->login($userIdentity, $duration);
	}
}
