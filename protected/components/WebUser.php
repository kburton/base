<?php

class WebUser extends CWebUser
{
	private $_user = null;

	public function getUser()
	{
		if ($this->_user === null)
			$this->_user = User::model()->findByPk($this->id);

		return $this->_user;
	}
	
	public function getIsAdmin()
	{
		$user = $this->getUser();
		
		return $user !== null && $user->isActive() && $user->IsAdmin;
	}

	/**
	 * Determines whether the user account is still accessible and logs the user out if not.
	 * @return boolean Whether the account is accessible
	 */
	public function checkAccountAccess()
	{
		$user = $this->getUser();

		if ($user === null || !$user->allowAccountAccess())
		{
			$this->logout();
			return false;
		}
		
		return true;
	}

	/**
	 * Ensures that the user account is still active when logging in.
	 * @param mixed $id
	 * @param array $states
	 * @param boolean $fromCookie
	 */
	protected function beforeLogin($id, $states, $fromCookie)
	{
		$this->_user = $user = User::model()->findByAttributes(array('Email'=>$id));

		if ($user === null || !$user->allowAccountAccess())
			return false;
		else
			return parent::beforeLogin($id, $states, $fromCookie);
	}

	/**
	 * Configures the WebUser details after login.
	 * @param boolean $fromCookie
	 */
	protected function afterLogin($fromCookie)
	{
		parent::afterLogin($fromCookie);
		
		$user = $this->getUser();
		
		$this->id = $user->Id;
		$this->name = $user->FirstName . ' ' . $user->LastName;
		$this->setState('email', $user->Email);
	}
	
}
