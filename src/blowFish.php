<?php

Class blowFish
{
	
	public $dig;

	public function __construct($digs = 5)
	{
		$this->dig = $digs;
	}


	public function crypt_blowfish($password) 
	{
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$', self::returnDig());
		for($i = 0; $i < 22; $i++)
		{
			$salt .= $set_salt[mt_rand(0, 10)];
		}
		return crypt($password, $salt);
	}

	public function returnDig()
	{
		$info = clone $this;
		return $info->dig;
	}	

	public function checkPassword($stringP, $password)
	{
		 $response = (crypt($stringP,$password) == $password) ? true:false;
		 return $response;
	}
}

?>