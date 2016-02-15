<?php

namespace ForFun\ArrayAware\Traits;

trait ArrayAwareTrait
{
    public function keys()
    {
        return array_keys($this->input);
    }

    public function has($key, $node = null)
    {
        if($node == null) {
            $node = $this->input;
        }

        if(preg_match('/\//', $key)) {
            return $this->hasChain($key, $node);
        }

        return isset($node[$key]);
    }

    // $instance->has('a/b/c');
    private function hasChain($key, $node = null)
    {
        $keys = explode('/', $key);
        if(count($keys) > 1) {
            $key = str_replace($keys[0] . '/', '', $key);
            $node = $node[$keys[0]];
        }

        return $this->has($key, $node);
    }

    public function get($key = null, $node = null)
    {
        if($key == null) {
            return $this->input;
        }

        if($node == null) {
            $node = $this->input;
        }

        if(!$this->has($key, $node)) {
            return null;
        }

        if(preg_match('/\//', $key)) {
            return $this->getChain($key, $node);
        }

        return $node[$key];
    }

    // $instance->get('a/b/c');
    public function getChain($key, $node = null)
    {
        $keys = explode('/', $key);
        if(count($keys) == 1) {
            return $node[$key];
        }

        $key = str_replace($keys[0] . '/', '', $key);

        return $this->get($key, $node[$keys[0]]);
    }
}
