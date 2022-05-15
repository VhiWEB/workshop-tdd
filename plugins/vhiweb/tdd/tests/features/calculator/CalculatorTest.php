<?php

namespace Vhiweb\TDD\Tests\Features\Calculator;

use PluginTestCase as BasePluginTestCase;
use Vhiweb\TDD\Calculator\Calculator;
use Vhiweb\TDD\Calculator\Operation\Addition;
use Vhiweb\TDD\Calculator\Operation\Multiplication;
use Vhiweb\TDD\Calculator\Operation\Subtraction;

class CalculatorTest extends BasePluginTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->calc = new Calculator;
    }

    /** @test */
    public function test_instance()
    {
        // then
        $this->assertEquals(true, is_object($this->calc));
    }

    /** @test */
    public function test_result_defaults_to_zero()
    {
        $this->assertSame(0, $this->calc->getResult());
    }

    /** @test */
    public function test_add_number()
    {
        $this->calc->setOperands(5);
        $this->calc->setOperation(new Addition);
        $result = $this->calc->calculate();
        $this->assertSame(5, $result);
    }
    /** @test */
    public function test_result_required_number_value()
    {
        try {
            $this->calc->setOperands('five');
            $this->calc->setOperation(new Addition);
            $this->calc->calculate();
            $this->expectException(\Exception::class);
        } catch (\Exception $e) {
            $this->assertSame('Not A Number', $e->getMessage());
            $this->assertSame(500, $e->getCode());
            return;
        }
    }

    /** @test */
    public function test_can_add_multiple_value()
    {
        $this->calc->setOperands(1, 2, 3, 4);
        $this->calc->setOperation(new Addition);
        $result = $this->calc->calculate();
        $this->assertSame(10, $result);
    }

    /** @test */
    public function test_substract_number()
    {
        $this->calc->setOperands(5);
        $this->calc->setOperation(new Subtraction);
        $result = $this->calc->calculate();
        $this->assertSame(-5, $result);
    }

    /** @test*/
    public function test_multiplication_number()
    {
        $this->calc->setOperands(5, 5);
        $this->calc->setOperation(new Multiplication);
        $result = $this->calc->calculate();
        $this->assertSame(25, $result);
    }
}
