<?php
namespace Cat\Core;
use \Cat\_Abstract;

class Engine extends _Abstract\AbstractEngine
{
	public static function launch() {
		return self::initialize()->deploy();
	}

	protected function deploy() {
		Routeur::run($this);
	}
}