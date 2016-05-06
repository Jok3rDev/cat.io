<?php

namespace Cat\Services;

class PathFactory {
	const PARENT_DIRECTORY = '..';
	const SCAN_EXCLUSION = array('.', '..');

	public static function get(string $base, int $numberOfBounds, array $path, string $fileName = null): string {
		$pathParts = array();
		$pathParts[] = $base;
		for ($i = 0; $i < $numberOfBounds; $i++) {
			$pathParts[] = self::PARENT_DIRECTORY;
		}
		if (!empty($path)) {
			foreach ($path as $value) {
				$pathParts[] = $value;
			}
		}
		
		if (!is_null($fileName)) {
			$pathParts[] = $fileName;
		}


		return implode(DIRECTORY_SEPARATOR, $pathParts);
	}

	public static function scanDirectory(string $directory): array {
		foreach (scandir($directory) as $value) {
			if (!in_array($value, self::SCAN_EXCLUSION)) {
				$tmp[] = $value;
			}
		}
		return $tmp;
	}
}

