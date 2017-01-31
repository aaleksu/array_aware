<?php

namespace ForFun\ArrayAware\Traits;

trait ArrayAwareTrait
{
    public function has(string $key) : bool
	{
		if(!is_array($this->context)) {
			return false;
		}

		return array_key_exists($key, $this->context);
	}

	public function get(string $key = null, $defaultValue = null)
	{
		if($key == null) {
			return $this->all();
		}

		if(preg_match('/\//', $key)) {
			return $this->getChain($key, $defaultValue);
		}

		if($this->has($key)) {
			$context = $this->context;
			$this->context = $this->input;

			return $context[$key];
		}

		return $defaultValue;
	}

	public function set(string $key, $value) : ArrayAware
	{
		$this->input[$key] = $value;

		return $this;
	}

	public function all() : array
	{
		return $this->input;
	}

	public function keys(string $path = null)
	{
		if($path == null) {
			return array_keys($this->input);
		}

		$node = $this->get($path, []);

		if(!is_array($node)) {
			return [];
		}

		return array_keys($node);
	}

	public function getChain(string $key, $defaultValue = null)
	{
		if(empty($key)) {
			return $this->context;
		}

		$keys = explode('/', $key);

		if(empty($keys)) {
			return $defaultValue;
		}

		if(count($keys) == 1) {
			return $this->context[$key];
		}

		if(empty($keys[1])) {
			return $this->get($keys[0], $defaultValue);
		}

		if(!$this->has($keys[0])) {
			return $defaultValue;
		}

		$this->context = $this->context[$keys[0]];
		$key = join('/', array_slice($keys, 1));

		return $this->get($key, $defaultValue);
	}
}
