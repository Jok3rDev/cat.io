<?php


namespace Cat\Services;


class Session
{
	private static $instance;

	private function __construct() {
		if (!static::isStarted()) {
			register_shutdown_function('session_write_close');
			session_start();
		}
	}

	public static function start()
	{
		if (!(static::$instance instanceof static)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	public static function isStarted() {
		return session_status() === PHP_SESSION_ACTIVE;
	}

	public static function isValid() {
		return isset($_SESSION['user']['u_id']);
	}

	public static function getSession(string $conf) {
		$tmp = &$_SESSION;
		if ($conf !== 'Public') {
			$tmp = &$_SESSION['user'];
		}
		return $tmp;
	}

	public static function isSessionNeeded(string $config): bool {
		return (bool) $config;
	}
	public static function getSessionApp(string $namespace) {
		$tmp = &$_SESSION['app'][$namespace];
		return $tmp;
	}

	public static function unsetSession() {
		unset($_SESSION);
		return true;
	}

	public static function closeSession() {
		return session_destroy();
	}
}