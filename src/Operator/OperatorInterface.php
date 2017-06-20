<?php

namespace ReversePolish\Operator;

/**
 * Interface OperatorInterface
 * @package ReversePolish\Operator
 */
interface OperatorInterface
{
    public function operate(\SplStack $stack) : float;
    public function getToken() : string;
    public function validate(\SplStack $stack) : bool;
}