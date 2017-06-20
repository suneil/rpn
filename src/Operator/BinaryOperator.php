<?php

namespace ReversePolish\Operator;

use ReversePolish\Exception\InvalidToken;

abstract class BinaryOperator
{
    const TOKEN = null;

    /**
     * @param \SplStack $stack
     * @return bool
     */
    public function validate(\SplStack $stack) : bool
    {
        if ($stack->count() < 2) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     * @throws InvalidToken
     */
    public function getToken() : string
    {
        if (static::TOKEN === null) {
            throw new InvalidToken("invalid token defined in " . __CLASS__);
        }

        // must use stack and not self
        return static::TOKEN;
    }

}