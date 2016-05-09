<?php


namespace Cat\_Abstract;


abstract class AbstractGlobal implements \Countable, \ArrayAccess, \Iterator
{
	public $global = array();
	abstract public function &getVariable();

	public function __construct()
	{
		$this->global = &$this->getVariable();
	}

	public function toArray()
	{
		return $this->global;
	}

	public function __get($name)
	{
		return $this->offsetGet($name);
	}

	public function __set($name, $value)
	{
		return $this->offsetSet($name, $value);
	}

	public function __isset($name)
	{
		return $this->offsetExists($name);
	}

	public function __unset($name)
	{
		return $this->offsetUnset($name);
	}

	public function count()
	{
		return count($this->global);
	}

	public function offsetExists($offset)
	{
		return array_key_exists($offset, $this->global);
	}

	public function offsetGet($offset)
	{
		if (!isset($this->$offset)) {
			return null;
		}

		return $this->global[ $offset ];
	}

	public function offsetSet($offset, $value)
	{
		$this->global[$offset] = $value;
	}

	public function offsetUnset($offset)
	{
		unset($this->global[ $offset ]);

		return $this;
	}

	public function current()
	{
		return current($this->global);
	}

	public function key()
	{
		return key($this->global);
	}

	public function next()
	{
		return next($this->global);
	}

	public function rewind()
	{
		return reset($this->global);
	}

	public function valid()
	{
		return null !== $this->key();
	}

}