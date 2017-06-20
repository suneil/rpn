<?php

namespace ReversePolish\Operator;

use ReversePolish\Exception\InvalidOperandCountException;

/**
 * Class Addition
 * @package ReversePolish\Operator
 */
class Add extends BinaryOperator implements OperatorInterface
{
    const TOKEN = '+';

    public function operate(\SplStack $stack) : float
    {
        $bool = $this->validate($stack);
        if ($bool === false) {
            throw new InvalidOperandCountException();
        }

        $b = $stack->pop();
        $a = $stack->pop();

        return floatval($a + $b);
    }
}