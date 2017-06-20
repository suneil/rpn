<?php

namespace ReversePolish\Tokenizer;

use SplStack;

class WhiteSpace implements TokenInterface
{
    public function tokenize(string $expression): SplStack
    {
        $stack = new SplStack();

        $tokens = preg_split("/[ \t]+/", $expression);

        foreach ($tokens as $token) {
            $stack->unshift($token);
        }

        return $stack;
    }
}