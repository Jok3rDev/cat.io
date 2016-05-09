<?php

namespace Cat\Services;

use \YAML\Parser;

class Parser {

	public static function parse(string $file) {
		$parser = static::newParser();
		$file = static::getFileContent($file);
		return $parser->parse($file);
	}

	protected static function getFileContent($file) {
		return file_get_contents($file);
	}

	protected static function newParser()
	{
		return new Parser();
	}
}

