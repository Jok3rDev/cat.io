<?php


namespace Cat\_Abstract;
use \Cat\Services;

abstract class AbstractRouteur
{
	protected static $instance;
	protected $controller;
	protected $method;
	protected $get;
	protected $server;
	protected $routesCollection;
	protected $defaultRoute;

	protected static function initialize(AbstractEngine $engine) {
		if (!(static::$instance instanceof static)) {
			static::$instance = new static($engine);
		}
		return static::$instance;
	}

	private function __construct(AbstractEngine $engine) {
		$this->setProperties($engine);
		if ($this->isRouteConfigFile()) {
			$this->getRouteCollection();
		}
		$this
			->handlerController()
			->handlerMethod()
			->handlerArguments()
			->prepareObjectInstance($engine->project['namespace'])
			->deploy($engine);
		;
		var_dump($this->get);
		var_dump($this->args);
	}

	protected function deploy($engine) {
		call_user_func_array(array(new $this->controller($engine), $this->method), $this->args);
	}

	protected function handlerController() {
		$this->controller = ucfirst($this->get->controller);
		if (!$this->issetController()) {
			$this->controller = 'Home';
			if ($this->isRouteConfigFile()) {
				$this->controller = $this->getDefaultRoute();
			}
		}

		$this->controller = $this->controller . 'Controller';

		return $this;
	}

	protected function handlerMethod() {
		$this->method =  ($this->get->method === '') ? 'main' : $this->get->method;
		return $this;
	}

	protected function handlerArguments() {
		if (is_array($this->get->args)) {
			$this->args = $this->get->args;
		} else {
			$this->args = explode('/', $this->get->args);
		}


		return $this;
	}

	protected function setProperties($engine) {
		$this->get 			 = $engine->get;
		$this->server		 = $engine->server;
		$this->route_file 	 = $engine::ROUTE_FILE;
		$this->cache_folder  = $engine::CACHE_FOLDER;
	}

	protected function isRouteConfigFile() {
		return file_exists(Services\PathFactory::get(__DIR__, 3, $this->cache_folder, $this->route_file));
	}

	protected function getRouteCollection() {
		$collection = Services\PathFactory::get(__DIR__, 3, $this->cache_folder, $this->route_file);
		$this->routesCollection = require_once $collection;
	}

	protected function getDefaultRoute() {
		return $this->routesCollection['default'];
	}

	protected function issetController() {
		return $this->get->controller;
	}

	protected function prepareObjectInstance($namespace) {
		$parts 	 = [];
		$parts[] = $namespace;
		$parts[] = 'Controllers';
		$parts[] = $this->controller;
		$this->controller = implode('\\', $parts);

		return $this;
	}
}