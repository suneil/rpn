<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ReversePolish\Calculator;

/**
 * @covers \ReversePolish\Operator\Add
 * @covers \ReversePolish\Operator\Subtract
 * @covers \ReversePolish\Operator\Multiply
 * @covers \ReversePolish\Operator\Divide
 */
final class OperatorTest extends TestCase
{
    public function testAdd()
    {
        $operator = new \ReversePolish\Operator\Add();

        $stack = new SplStack();
        $stack->push(5);
        $stack->push(4);

        $result = $operator->operate($stack);

        $this->assertEquals(9, $result);
    }

    public function testSubtract()
    {
        $operator = new \ReversePolish\Operator\Subtract();

        $stack = new SplStack();
        $stack->push(15);
        $stack->push(7);

        $result = $operator->operate($stack);

        $this->assertEquals(8, $result);
    }

    public function testMultiply()
    {
        $operator = new \ReversePolish\Operator\Multiply();

        $stack = new SplStack();
        $stack->push(15);
        $stack->push(7);

        $result = $operator->operate($stack);

        $this->assertEquals(105, $result);
    }

    public function testDivide()
    {
        $operator = new \ReversePolish\Operator\Divide();

        $stack = new SplStack();
        $stack->push(15);
        $stack->push(7);

        $result = $operator->operate($stack);

        // Is this really ok? should reconsider using a result that doesn't
        // have an infinite repeating decimal pattern
        $this->assertEquals(2.1428571428571428, $result);
    }
}