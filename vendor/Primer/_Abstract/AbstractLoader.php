<?php
/**
 * Created by PhpStorm.
 * User: ftj0k
 * Date: 27/04/2016
 * Time: 10:25
 */

namespace Primer\_Abstract;


abstract class AbstractLoader
{
	protected static $instance;
	protected $classCollection = array();

	const PARENT_DIRECTORY = '..';
	const CLASS_EXTENSION = '.php';
	const VENDOR_DIRECTORY = 'vendor';


	abstract protected function getVendorDirectory();
	abstract protected function getApplicationDirectory();

	public static function register() {
		return static::run()->handlerClassDirectories()->autoload();
	}

	protected function handlerClassDirectories() {
		$this->classCollection = $this->getDirectories();

		return $this;
	}

	protected function getDirectories() {
		return array_merge(
			$this->getApplicationDirectory(),
			$this->getVendorDirectory()
		);
	}

	protected function processPathDirectory(string $base, int $numberOfBounds, $path = null) {
		$pathParts = array();
		$pathParts[] = $base;
		for ($i = 0; $i < $numberOfBounds; $i++) {
			$pathParts[] = self::PARENT_DIRECTORY;
		}
		if (!is_null($path)) {
			$pathParts[] = $path;
		}

		return array(implode(DIRECTORY_SEPARATOR, $pathParts));
	}

	protected function autoload() {
		spl_autoload_register(array($this, "myAutoload"));
		return $this;
	}

	protected function myAutoload($className) {
		$class = $this->sanitizeCLass($className);
		$list = $this->getPath($class);
		$this->load($list);
	}

	private function sanitizeCLass($name) {
		return DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $name);
	}

	private function load($list) {
		foreach ($list as $value) {
			if (file_exists($value)) {
				includeFile($value);
				return true;
			}
		}
	}

	protected function getPath($pClassName) {
		$retour = array();
		foreach ($this->classCollection as $key => $value) {
			$retour[] = $value . $pClassName. self::CLASS_EXTENSION;
		}

		return $retour;
	}

}
function includeFile($file) {
	require_once $file;
}