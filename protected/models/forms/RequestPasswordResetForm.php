<?php

class RequestPasswordResetForm extends CFormModel
{
	public $email;
	public $captcha;

	private $_user;

	public function rules()
	{
		return array(
			array('email, captcha', 'required'),
			array('email', 'email'),
			array('captcha', 'captcha'),
			array('email', 'exist', 'className'=>'User', 'attributeName'=>'Email', 'skipOnError'=>true,
				'message'=>Yii::t('user', 'email_not_registered')),
			array('email', 'accountIsActive', 'skipOnError'=>true),
		);
	}

	public function attributeLabels()
	{
		return array(
			'captcha'=>'Image Verification',
		);
	}

	private function getUser()
	{
		if ($this->_user === null)
			$this->_user = User::model()->findByAttributes(array('Email'=>$this->email));

		return $this->_user;
	}

	public function accountIsActive()
	{
		$user = $this->getUser();

		if ($user === null || !$user->isActive())
			$this->addError('email', Yii::t('user', 'account_no_longer_active'));
	}

	/**
	 * Should only be called once validation is successful.
	 */
	public function processPasswordResetRequest()
	{
		$user = $this->getUser();

		$verificationCode = new VerificationCode;
		$verificationCode->ForeignTableId = $user->Id;
		$verificationCode->Type = 'password_reset';
		$verificationCode->UserId = $user->Id;
		$verificationCode->expiresInHours = 48;

		if (!$verificationCode->save())
		{
			throw new Exception(
				'Sorry, the system has been unable to generate a password reset code for your account.');
		}
		else if (!KSMail::sendPasswordResetEmail($user, $verificationCode))
		{
			throw new Exception(
				'Sorry, the system has been unable to send a password reset email '
				. 'to your registered account.<br />Please try again in a few minutes.');
		}
	}
}
