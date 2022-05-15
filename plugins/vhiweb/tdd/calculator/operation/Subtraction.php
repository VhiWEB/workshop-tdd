<?php

namespace Vhiweb\TDD\Calculator\Operation;

use Vhiweb\TDD\Calculator\Contract\Operation;

class Subtraction implements Operation
{
    public function run($num, $current)
    {
        return $current - $num;
    }
}
