<?php
namespace Fago\Predicates;

interface IntPredicate
{
    
    public function test( int $value ):bool;
    
    public function and(IntPredicate $other): IntPredicate;
    
    public function or(IntPredicate $other): IntPredicate;
    
    public function negate(): IntPredicate;
    
    /**
     * @param int $value
     * @return bool
     */
    public function __invoke($value);
    
}

