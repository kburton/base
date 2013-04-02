<?php

class Password extends CComponent
{
	private $plainTextPassword;
	private $salt;

	const MINIMUM_LENGTH = 8;

	public function __construct($plainTextPassword, $salt)
	{
		$this->plainTextPassword = $plainTextPassword;
		$this->salt = $salt;
	}

	public function isValid()
	{
		return $this->isLongEnough()
			&& $this->containsNumber()
			&& $this->containsLowerCaseChar()
			&& $this->containsUpperCaseChar();
	}

	public function getErrorMessage()
	{
		if ($this->isValid())
			return null;

		if (!$this->isLongEnough())
			return 'Password must contain at least ' . self::MINIMUM_LENGTH . ' characters.';
		if (!$this->containsNumber())
			return 'Password must contain at least one number.';
		if (!$this->containsLowerCaseChar())
			return 'Password must contain at least one lower-case letter.';
		if (!$this->containsUpperCaseChar())
			return 'Password must contain at least one upper-case letter.';

		return self::getPolicyMessage();
	}

	public static function getPolicyMessage()
	{
		return 'Password must be at least ' . self::MINIMUM_LENGTH
			 . ' characters long and contain at least one number,'
			 . ' one lower case character and one upper case character.';
	}

	private function isLongEnough()
	{
		return strlen($this->plainTextPassword) >= self::MINIMUM_LENGTH;
	}

	private function containsNumber()
	{
		return preg_match('/[0-9]/', $this->plainTextPassword);
	}

	private function containsLowerCaseChar()
	{
		return preg_match('/[a-z]/', $this->plainTextPassword);
	}

	private function containsUpperCaseChar()
	{
		return preg_match('/[A-Z]/', $this->plainTextPassword);
	}

	public function getHash()
	{
		return hash('sha512', strtolower($this->salt) . $this->plainTextPassword);
	}
}
