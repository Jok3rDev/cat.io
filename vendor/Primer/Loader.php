<?php
/**
 * Created by PhpStorm.
 * User: ftj0k
 * Date: 27/04/2016
 * Time: 10:22
 */

namespace Primer;

require_once '_Abstract\AbstractLoader.php';

class Loader extends _Abstract\AbstractLoader
{
	protected static function run() {
		if (!isset(static::$instance)) {
			$class = __CLASS__;
			static::$instance = new $class;
		}
		return static::$instance;
	}
	protected function getVendorDirectory()
	{
		return parent::processPathDirectory(__DIR__, 1);
	}
	
	protected function getApplicationDirectory()
	{
		return parent::processPathDirectory(__DIR__, 2, 'class');
	}
}