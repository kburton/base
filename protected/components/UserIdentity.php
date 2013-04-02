<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $passwordVerifier;
	private $user;

	const ERROR_ACCOUNT_NOT_ACTIVE = 101;
	const ERROR_TOO_MANY_FAILED_LOGINS = 102;

	public function __construct($username, $passwordVerifier)
	{
		$this->passwordVerifier = $passwordVerifier;

		// Leave password blank as it isn't used in verification
		parent::__construct($username, '');
	}

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$this->user = User::model()->findByAttributes(array('Email'=>$this->username));

		if ($this->user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else if (!$this->user->isActive())
			$this->errorCode = self::ERROR_ACCOUNT_NOT_ACTIVE;
		else if ($this->user->tooManyFailedLogins())
			$this->errorCode = self::ERROR_TOO_MANY_FAILED_LOGINS;
		else if ($this->passwordVerifier->getHash() !== $this->user->Password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode = self::ERROR_NONE;

		return !$this->errorCode;
	}

	public function getUser()
	{
		return $this->user;
	}
	
}
