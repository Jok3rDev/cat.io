<?php


namespace Cat\Globals;

class Post extends \Cat\_Abstract\AbstractGlobal
{
	public function &getVariable()
	{
		return $_POST;
	}
}