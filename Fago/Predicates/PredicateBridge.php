<?php
namespace Fago\Predicates;

/**
 * @template T
 * @implements Predicate<T>
 */
final class PredicateBridge implements Predicate{
    
    /** @var \Closure(T):bool $closure */
    private \Closure $closure;
    
    /** @param \Closure(T):bool $closure */
    private final function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }
    
    /**
     * @template R
     * @param \Closure(R):bool $closure
     * @return Predicate<R>
     */
    protected static function create(\Closure $closure):Predicate
    {
        return new PredicateBridge($closure);
    }
    
    /** @param T $type */
    public final function test($type):bool
    {
        return ($this->closure)($type);
    }
    
    public final function and(Predicate $other): Predicate
    {
        return new PredicateBridge (/** @param T $x */ fn($x):bool => $this->test($x) && $other->test($x));
    }
    
    public final function or(Predicate $other): Predicate
    {
        return new PredicateBridge ( /** @param T $x */ fn($x):bool => $this->test($x) || $other->test($x));
    }
    
    
    public final function negate(): Predicate
    {
        return new PredicateBridge ( /** @param T $x */ fn($x):bool => !$this->test($x));
    }
    
    /**
     * @param T $type
     * @return bool
     */
    public final function __invoke($type)
    {
        return $this->test($type);
    }
    
}


