<?php
namespace Fago\Predicates;



/**
 * @template T
 * @param \Closure(T):bool $testOperation
 * @return Predicate<T>
 * @throw \RuntimeException
 */
function predicate(\Closure $testOperation): Predicate
{
    /** @var Closure(class-string):Predicate<T>|false $result */
    $result =  \Closure::bind(
        function(string $clazz) use ($testOperation):Predicate
        {
            /** @var callable(\Closure):Predicate<T> $cTor */ $cTor = [$clazz,'create'];
            return $cTor($testOperation);
    },
    NULL,
    PredicateBridge::class);
    
    if($result !== false){
        return $result(PredicateBridge::class);
    }
    throw new \RuntimeException("can't create Predicate!");
}


/**
 * 
 * @param \Closure(int):bool $testOperation
 * @return IntPredicate
 */
function intPredicate(\Closure $testOperation):IntPredicate
{
    /** @var Closure(class-string):IntPredicate|false $result */
    $result =  \Closure::bind(
        function(string $clazz) use ($testOperation):IntPredicate
        {
            /** @var callable(\Closure):IntPredicate $cTor */ $cTor = [$clazz,'create'];
            return $cTor($testOperation);
    },
    NULL,
    IntPredicateBridge::class);
    
    if($result !== false){
        return $result(IntPredicateBridge::class);
    }
    throw new \RuntimeException("can't create intPredicate!");
}


/**
 *
 * @param \Closure(string):bool $testOperation
 * @return StringPredicate
 */
function stringPredicate(\Closure $testOperation):StringPredicate
{
    /** @var Closure(class-string):IntPredicate|false $result */
    $result =  \Closure::bind(
        function(string $clazz) use ($testOperation):StringPredicate
        {
            /** @var callable(\Closure):IntPredicate $cTor */ $cTor = [$clazz,'create'];
            return $cTor($testOperation);
    },
    NULL,
    StringPredicateBridge::class);
    
    if($result !== false){
        return $result(StringPredicateBridge::class);
    }
    throw new \RuntimeException("can't create stringPredicate!");
}
