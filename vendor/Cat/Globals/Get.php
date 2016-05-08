<?php


namespace Cat\Globals;

class Get extends \Cat\_Abstract\AbstractGlobal
{
	public function &getVariable()
	{
		return $_GET;
	}
}