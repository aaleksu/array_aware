<?php

namespace ForFun\FunArray;

interface ArrayInterface
{
    public function keys();
    public function has($key, $node = null);
    public function get($key = null, $node = null);
}
