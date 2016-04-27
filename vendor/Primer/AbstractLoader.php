<?php
/**
 * Created by PhpStorm.
 * User: ftj0k
 * Date: 27/04/2016
 * Time: 10:25
 */

namespace Primer;


class AbstractLoader
{
	protected static $instance;
	protected $classCollection = array();
	const CLASS_EXTENSION = '.php';
/*	const VENDOR_DIRECTORY = 'vendor';*/
}