<?php


namespace Cat\_Abstract;


abstract class AbstractController
{
	protected $get;
	protected $post;

	protected $session;
	protected $app;

	protected $project;
	
	private $view;

	protected $data = array();

	abstract public function main();
	public function __construct(AbstractEngine $engine)
	{
		$this->hydrateControllerProperties($engine);
	}

	private function hydrateControllerProperties(AbstractEngine $engine) {
		$this->get = $engine->get;
		$this->post = $engine->post;
		$this->session = $engine->session;
		$this->app = $engine->app;
		$this->project = $engine->project;
		$this->view = $this->setView($engine->pages);
	}
	
	private function setView($config) {
		$page = $this->get->controller === '' || is_null($this->get->controller) ? 'home' : $this->get->controller;

		if (array_key_exists(strtolower($page), $config)) {
			return new \Cat\Page($config[$page]);
		}
		return new \Cat\Page($config['default']);
	}

	protected function display(array $data = null) {
		if(is_array($data)) {
			$this->compose($data);
		}

		new \Cat\View($this);
		die();
	}

	protected function compose(array $data) {
		foreach($data as $key => $value) {
			$this->data[$key] = $value;
		}
	}
}