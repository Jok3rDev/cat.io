<?php

namespace Cat\Services;

use \HJSON\HJSONParser;
use \HJSON\HJSONStringifier;

class Parser {

	public static function parse(string $file, bool $keepWSC = false) {
		$parser = static::newParser();
		$file = static::getFileContent($file);
		$obj = $parser->parse($file);
		if ($keepWSC) {
			$obj = $parser->parseWsc($file);
		}
		return $obj;
	}

	protected static function getFileContent($file) {
		return file_get_contents($file);
	}

	protected static function newParser()
	{
		return new HJSONParser();
	}
}

