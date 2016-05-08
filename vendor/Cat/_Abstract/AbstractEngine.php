<?php
namespace Cat\_Abstract;

use \Cat\Services;
use \Cat\Globals;

abstract class AbstractEngine
{
	protected static $instance;
	protected $project;
	
	protected $get;
	protected $post;
	protected $server;
	protected $session;
	protected $app;
	protected $file;

	const ROUTE_FILE = 'Routes.php';
	const PROJECT_FILE = 'Project.php';
	const CACHE_FOLDER = array('cache', 'app');

	protected static function initialize() {
		if (!(static::$instance instanceof static)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	private function __construct() {
		$this
			->setGlobals()
			->getConfiguration()
			->setSession()
		;
	}

	public function __get($property) {
		return $this->$property;
	}

	private function setGlobals() {
		$this->get 		= new Globals\Get;
		$this->post 	= new Globals\Post;
		$this->server 	= $_SERVER;

		return $this;
	}

	private function getConfiguration() {
		$project = Services\PathFactory::get(__DIR__, 3, self::CACHE_FOLDER, self::PROJECT_FILE);
		$this->project = require_once $project;

		return $this;
	}

	private function setSession() {
		if (Services\Session::isSessionNeeded($this->project['needSession'])) {
			Services\Session::start();
			$this->session = Services\Session::getSession($this->project['environment']);
			$this->app	   = Services\Session::getSessionApp($this->project['sessionAppNamespace']);
		}
		return $this;
	}

	abstract public static function launch();
	abstract protected function deploy();
}