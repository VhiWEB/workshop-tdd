<?php

namespace Vhiweb\TDD\Calculator\Operation;

use Vhiweb\TDD\Calculator\Contract\Operation;

class Multiplication implements Operation
{
    public function run($num, $current)
    {
        if ($current === 0) return $num;
        return $current * $num;
    }
}
