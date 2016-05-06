<?php
namespace Cat\Core;
use \Cat\_Abstract;

class Engine extends _Abstract\AbstractEngine
{
	public static function launch() {
		var_dump('TOTO');
		return self::initialize();
	}
}