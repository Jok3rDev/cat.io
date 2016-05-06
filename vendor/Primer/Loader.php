<?php
/**
 * Created by PhpStorm.
 * User: ftj0k
 * Date: 27/04/2016
 * Time: 10:22
 */

namespace Primer;

require_once '_Abstract\AbstractLoader.php';

class Loader extends _Abstract\AbstractLoader
{
	protected function getVendorDirectory()
	{
		return parent::processPathDirectory(__DIR__, 1);
	}
	
	protected function getApplicationDirectory()
	{
		return parent::processPathDirectory(__DIR__, 2, 'class');
	}
}