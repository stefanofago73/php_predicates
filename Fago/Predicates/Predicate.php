<?php declare(strict_types = 1);

namespace Fago\Predicates;

/**
 *
 * @template T
 *
 */
interface Predicate
{
    /** @param T $type */
    public function test( $type ):bool;
    
    /**
     * @param Predicate<T> $other
     * @return Predicate<T>
     *
     */
    public function and(Predicate $other): Predicate;
    
    /**
     * @param Predicate<T> $other
     * @return Predicate<T>
     *
     */
    public function or(Predicate $other): Predicate;
    
    /**
     *
     * @return Predicate<T>
     *
     */
    public function negate(): Predicate;
    
    /**
     * @param T $type
     * @return bool
     */
    public function __invoke($type);
}

