<?php

Class blowFish
{
	
	public $dig;

	public function __construct($dig = 5)
	{
		$this->$dig = $dig;
	}


	static public function crypt_blowfish($password) 
	{
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$', $this->dig);
		for($i = 0; $i < 22; $i++)
		{
			$salt .= $set_salt[mt_rand(0, 10)];
		}
		return crypt($password, $salt);
	}

	static public function checkPassword($stringP, $password)
	{
		 return (crypt($stringP,$password) == $password) ? true:false;
	}
}

?>