<?php

namespace Vhiweb\TDD\Calculator\Contract;

interface Operation
{
    public function run($num, $current);
}
