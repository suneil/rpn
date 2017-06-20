<?php

namespace ReversePolish\Operator;

use ReversePolish\Exception\InvalidOperandCountException;

/**
 * Class Multiply
 * @package ReversePolish\Operator
 */
class Multiply extends BinaryOperator implements OperatorInterface
{
    const TOKEN = 'x';

    public function operate(\SplStack $stack) : float
    {
        $bool = $this->validate($stack);
        if ($bool === false) {
            throw new InvalidOperandCountException();
        }

        $b = $stack->pop();
        $a = $stack->pop();

        return floatval($a * $b);
    }
}