<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use ReversePolish\Calculator;

/**
 * @covers Calculator
 */
final class CalculatorTest extends TestCase
{
    public function testValidPostfix()
    {
        $expression = '5 1 2 + 4 x + 3 -';

        $calculator = new Calculator();
        $result = $calculator->compute($expression);

        $this->assertEquals(14, $result, 'Invalid result');
    }

    public function testInvalidPostfix()
    {
        $expression = '5 1 2 + 4 x + 3 - -';

        $calculator = new Calculator();

        try {
            $calculator->compute($expression);
        } catch (\Exception $e) {
            $this->assertEquals(\ReversePolish\Exception\InvalidOperandCountException::class, get_class($e));
        }
    }

}