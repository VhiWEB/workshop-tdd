<?php

namespace Vhiweb\TDD\Calculator;

use Vhiweb\TDD\Calculator\Contract\Operation;

class Calculator
{
    protected $result = 0;
    protected $operands = [];
    protected $operations;

    public function getResult()
    {
        return $this->result;
    }

    public function add()
    {
        $this->calculateAll(func_get_args(), '+');
    }

    public function substract()
    {
        $this->calculateAll(func_get_args(), '-');
    }

    public function calculateAll(array $nums, $symbol)
    {
        foreach ($nums as $num) {
            $this->calculate($num, $symbol);
        }
    }

    // public function calculate($num, $symbol)
    // {
    //     if (!is_numeric($num)) {
    //         throw new \Exception('Not A Number', 500);
    //     }
    //     switch ($symbol) {
    //         case '+':
    //             $this->result += $num;
    //             break;
    //         case '-':
    //             $this->result -= $num;
    //             break;
    //     }
    // }
    public function calculate()
    {
        foreach ($this->operands as $num) {
            if (!is_numeric($num)) {
                throw new \Exception('Not A Number', 500);
            }
            $this->result = $this->operations->run($num, $this->result);
        }
        return $this->result;
    }

    public function setOperands()
    {
        $this->operands = func_get_args();
        return $this;
    }

    public function setOperation(Operation $operation)
    {
        $this->operations = $operation;
        return $this;
    }
}
