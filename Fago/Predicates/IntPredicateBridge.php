<?php
namespace Fago\Predicates;

final class IntPredicateBridge implements IntPredicate
{

    /** @var \Closure(int):bool $closure */
    private \Closure $closure;

    /**
     *
     * @param \Closure(int):bool $closure
     */
    private final function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     *
     * @param \Closure(int):bool $closure
     * @return IntPredicate
     */
    protected static function create(\Closure $closure): IntPredicate
    {
        return new IntPredicateBridge($closure);
    }

    public function test(int $value): bool
    {
        return ($this->closure)($value);
    }

    public function and(IntPredicate $other): IntPredicate
    {
        return new IntPredicateBridge(fn (int $x): bool => $this->test($x) && $other->test($x));
    }

    public function or(IntPredicate $other): IntPredicate
    {
        return new IntPredicateBridge(fn (int $x): bool => $this->test($x) || $other->test($x));
    }

    public function negate(): IntPredicate
    {
        return new IntPredicateBridge(fn (int $x): bool => ! $this->test($x));
    }

    public function __invoke($value)
    {
        return $this->test($value);
    }
}

