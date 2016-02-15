<?php

namespace ForFun\ArrayAware;

interface ArrayAwareInterface
{
    public function keys();
    public function has($key, $node = null);
    public function get($key = null, $node = null);
}
