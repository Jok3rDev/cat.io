<?php


namespace Cat;


class Page
{
	public function __construct(array $config)
	{
		$this->hydrate($config);
	}

	private function hydrate($config) {
		foreach ($config as $key => $value) {
			$this->$key = $value;
		}
	}
}