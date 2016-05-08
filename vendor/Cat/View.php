<?php


namespace Cat;

use Cat\Services;
use Cat\_Abstract\AbstractController;

class View {
	private $config;
	private $loader;
	public function __construct(AbstractController $controller)
	{
		$this
			->getConfig()
			->getLoader()
			->getAdminLayout()
			->getEnvironment()
			->loadTemplate()
			->initializeRender()
			->diplay()
		;

	}
	
	private function loader() {
		return new \Twig_Loader_Filesystem($this->config['fileSystem']['base']);
	}

	private function getConfig() {
		$file = Services\PathFactory::get(__DIR__, 2, array('cache', 'app'), 'Twig.php');
		$this->config = require_once $file;

	}

	
}