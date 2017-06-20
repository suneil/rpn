<?php

namespace ReversePolish;

use ReversePolish\Exception\InvalidInputException;
use ReversePolish\Exception\InvalidToken;
use ReversePolish\Tokenizer\TokenInterface;
use ReversePolish\Tokenizer\WhiteSpace;
use ReversePolish\Operator\Divide;
use ReversePolish\Operator\Multiply;
use ReversePolish\Operator\OperatorInterface;
use ReversePolish\Operator\Add;
use ReversePolish\Operator\Subtract;

class Calculator
{
    /**
     * @var OperatorInterface[]
     */
    private $operators = [];

    /**
     * @var WhiteSpace
     */
    private $tokenizer;

    /**
     * Calculator constructor.
     * @param TokenInterface|null $tokenizer
     */
    public function __construct(TokenInterface $tokenizer = null)
    {
        // Register standard operators
        $this->registerOperator(new Add());
        $this->registerOperator(new Subtract());
        $this->registerOperator(new Divide());
        $this->registerOperator(new Multiply());

        // Use default whitespace tokenizer if none has been passed in
        $this->tokenizer = $tokenizer ?: new WhiteSpace();
    }

    /**
     * @param string $expression
     * @return float
     * @throws InvalidInputException
     * @throws InvalidToken
     */
    public function compute(string $expression) : float
    {
        $tokens = $this->getTokens($expression);
        $stack = new \SplStack();

        foreach ($tokens as $token) {
            if (isset($this->operators[$token])) {
                $result = $this->operators[$token]->operate($stack);
                $stack->push($result);
            } else {
                if (!is_numeric($token)) {
                    throw new InvalidToken("invalid token $token");
                }
                $stack->push($token);
            }
        }

        if ($stack->count() > 1) {
            throw new InvalidInputException("Too many inputs");
        }

        $final = floatval($stack->pop());
        return $final;
    }

    /**
     * Register an operator. Must implement the OperatorInterface
     *
     * @param OperatorInterface $operator
     */
    public function registerOperator(OperatorInterface $operator)
    {
        $this->operators[$operator->getToken()] = $operator;
    }

    /**
     * Tokenize expression
     *
     * @param string $expression
     * @return \SplStack
     */
    private function getTokens(string $expression): \SplStack
    {
        return $this->tokenizer->tokenize($expression);
    }
}