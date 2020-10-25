<?php
namespace Fago\Predicates;

interface StringPredicate
{
    
    public function test( string $value ):bool;
    
    public function and(StringPredicate $other): StringPredicate;
    
    public function or(StringPredicate $other): StringPredicate;
    
    public function negate(): StringPredicate;
    
    /**
     * @param string $value
     * @return bool
     */
    public function __invoke($value);
    
}

