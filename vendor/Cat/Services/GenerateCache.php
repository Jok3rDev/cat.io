<?php

namespace Cat\Services;

class GenerateCache
{
	const CONFIG_EXTENSION = '.hjson';
	const CACHE_EXTENSION  = '.php';
	const CHMOD_RIGHT = 0775;
	const WWW_DATA_GROUP = 33;

	private static $instance;
	private $listFiles = array();
	private $cacheDestination;
	private $configPath;

	protected static function initialize() {
		if (!(static::$instance instanceof static)) {
			static::$instance = new static;
		}
		return static::$instance;
	}
	public static function generate() {
		return self::initialize()
			->getConfigFilesPath()
			->getFiles()
			->generateCache();
	}
	
	private function getConfigFilesPath() {
		$this->configPath = PathFactory::get(__DIR__, 3, array('config'));
		return $this;
	}

	private function getFiles() {
		$path = PathFactory::scanDirectory($this->configPath);

		foreach ($path as $key => $value) {
			$configFile = PathFactory::get(__DIR__, 3, array('config'), $value);
			$tmpCacheFile = self::removeConfigExtension($value);
			$tmpCacheFile = self::addCacheExtension($tmpCacheFile);
			$cacheFile 	= PathFactory::get(__DIR__, 3, array('cache', 'app'), $tmpCacheFile);
			$this->listFiles[$key]['conf'] = $configFile;
			$this->listFiles[$key]['cache'] = $cacheFile;
		}
		return $this;
	}

	private function generateCache() {
		foreach ($this->listFiles as $value) {
			$this->touchCacheFile($value['cache']);
			$this->insertCache($value['conf'], $value['cache']);
		}
	}

	private function insertCache($conf, $cache) {
		$date = date('d/m/y');
		$time = date('H:i:s');
		$author = __CLASS__;
		$file = __FILE__;

		$var = var_export(Parser::parse($conf), true);

		$content = <<<FILE
<?php

/*
   Fichier automatiquement généré le $date à $time
   Par $author ($file)

   Ne pas modifier à la main !!

   Il sera automatiquement mis à jour ou recréé en cas de besoin.
   Ce fichier contient les différents paramètres nécéssaires au fonctionnement de l'application
*/

return $var;

FILE;

		file_put_contents($cache, $content);

		return $this;

	}

	private function touchCacheFile($file) {
		if (!is_file($file)) {
			touch($file);
			chmod($file, self::CHMOD_RIGHT);
			chgrp($file, self::WWW_DATA_GROUP);
		}

		return $this;
	}

	private static function removeConfigExtension(string $fileName): string {
		return rtrim($fileName, self::CONFIG_EXTENSION);
	}

	private static function addCacheExtension(string $fileName): string {
		return $fileName . self::CACHE_EXTENSION;
	}

}