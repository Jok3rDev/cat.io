<?php
namespace Cat\_Abstract;


abstract class AbstractEngine
{
	protected static $instance;
	protected $project;
	
	protected $get;
	protected $post;
	protected $server;
	protected $session;
	protected $file;

	protected static function initialize() {
		if (!(static::$instance instanceof static)) {
			static::$instance = new static;
		}
		return static::$instance;
	}

	private function __construct() {
		$this
			->setGlobals();
	}

	private function setGlobals() {
		$this->get = $_GET;
		$this->post = $_POST;
		$this->server = $_SERVER;

		return $this;
	}

	abstract public static function launch();
}