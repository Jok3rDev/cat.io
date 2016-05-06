<?php
/**
 * Created by PhpStorm.
 * User: ftj0k
 * Date: 27/04/2016
 * Time: 10:25
 */

namespace Primer;


class AbstractLoader
{
	protected static $instance;
	protected $classCollection = array();
	const CLASS_EXTENSION = '.php';
	const VENDOR_DIRECTORY = 'vendor';

	abstract protected function getInstalleurDirectories();
	abstract protected function getVendorDirectory();
	abstract protected function getApplicationDirectory();

	protected static function run() {
		if (!(static::$instance instanceof static)) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	protected static function register() {
		return static::run();
	}
}