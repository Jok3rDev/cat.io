<?php


namespace Cat\Core;
use \Cat\_Abstract;

class Routeur extends _Abstract\AbstractRouteur
{
	public static function run(_Abstract\AbstractEngine $engine) {
		return self::initialize($engine);
	}
}