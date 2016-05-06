<?php

namespace Cat\Services;

class PathFactory {
	const PARENT_DIRECTORY = '..';

	public static function get(string $base, int $numberOfBounds, array $path, string $fileName): string {
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

		$pathParts[] = $fileName;

		return implode(DIRECTORY_SEPARATOR, $pathParts);
	}
}

