<?php

namespace ForFun\ArrayAware;

use ForFun\ArrayAware\Traits\ArrayAwareTrait;

class ArrayAware implements ArrayAwareInterface
{
    use ArrayAwareTrait;

    private $input;

    public function __construct(array $input = [])
    {
        $this->input = $input;
    }
}