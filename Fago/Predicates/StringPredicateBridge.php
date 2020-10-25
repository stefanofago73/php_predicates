<?php
namespace Fago\Predicates;

final class StringPredicateBridge implements StringPredicate
{

    /** @var \Closure(string):bool $closure */
    private \Closure $closure;

    /**
     *
     * @param \Closure(string):bool $closure
     */
    private final function __construct(\Closure $closure)
    {
        $this->closure = $closure;
    }

    /**
     *
     * @param \Closure(string):bool $closure
     * @return StringPredicate
     */
    protected static function create(\Closure $closure): StringPredicate
    {
        return new StringPredicateBridge($closure);
    }

    public function test(string $value): bool
    {
        return ($this->closure)($value);
    }

    public function and(StringPredicate $other): StringPredicate
    {
        return new StringPredicateBridge(fn (string $x): bool => $this->test($x) && $other->test($x));
    }

    public function or(StringPredicate $other): StringPredicate
    {
        return new StringPredicateBridge(fn (string $x): bool => $this->test($x) || $other->test($x));
    }

    public function negate(): StringPredicate
    {
        return new StringPredicateBridge(fn (string $x): bool => ! $this->test($x));
    }

    public function __invoke($value)
    {
        return $this->test($value);
    }
}

