<?php


namespace Cat;

use Cat\Services;
use Cat\_Abstract\AbstractController;

class View {
	private $config;
	private $loader;
	private $twig;
	public function __construct(AbstractController $controller)
	{
		$this
			->getConfig()
			->getLoader()
			->getAdminLayout()
			->getConsoleLayout()
			->getEnvironment()
			->loadTemplate()
			->initializeRender()
			->diplay()
		;

	}
	
	private function getLoader() {
		$this->loader = new \Twig_Loader_Filesystem($this->config['fileSystem']['base']);
		return $this;
	}

	private function getConfig() {
		$file = Services\PathFactory::get(__DIR__, 2, array('cache', 'app'), 'Twig.php');
		$this->config = require_once $file;
		return $this;
	}

	private function getAdminLayout() {
		if (array_key_exists('admin', $this->config['fileSystem'])) {
			$this->loader->addPath($this->config['fileSystem']['admin'], 'admin');
		}
		return $this;
	}
	private function getConsoleLayout() {
		if (array_key_exists('console', $this->config['fileSystem'])) {
			$this->loader->addPath($this->config['fileSystem']['console'], 'console');
		}
		return $this;
	}

	private function getEnvironment() {
		
	}

	
}