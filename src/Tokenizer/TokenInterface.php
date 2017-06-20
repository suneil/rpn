<?php

namespace ReversePolish\Tokenizer;

interface TokenInterface
{
    public function tokenize(string $expression) : \SplStack;
}