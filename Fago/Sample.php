<?php
namespace Fago;

require dirname(__FILE__) . '/Predicates/Predicate.php';
require dirname(__FILE__) . '/Predicates/IntPredicate.php';
require dirname(__FILE__) . '/Predicates/StringPredicate.php';
require dirname(__FILE__) . '/Predicates/PredicateBridge.php';
require dirname(__FILE__) . '/Predicates/IntPredicateBridge.php';
require dirname(__FILE__) . '/Predicates/StringPredicateBridge.php';
require dirname(__FILE__) . '/Predicates/Support.php';
require dirname(__FILE__) . '/IntHolder.php';

use Fago\Predicates\IntPredicate;
use Fago\Predicates\Predicate;
use Fago\Predicates\StringPredicate;
use function Fago\Predicates\intPredicate;
use function Fago\Predicates\predicate;
use function Fago\Predicates\stringPredicate;



class Sample
{
    
    private static function predicateResultForInt(int $x, IntPredicate $predicate):void
    {
        echo "for value $x, evaluate to : ".($predicate($x)?"true":"false").PHP_EOL;
    }
    
    private static function predicateResultForString(string $x, StringPredicate $predicate ):void
    {
        echo "for value '$x', evaluate to : ".($predicate($x)?"true":"false").PHP_EOL;
    }
    
    
    private static function predicateResultForObject(IntHolder $x, Predicate $predicate ):void
    {
        echo "for value $x->value, evaluate to : ".($predicate($x)?"true":"false").PHP_EOL;
    }
    
    public static function Usage():void
    {
        $numPredicate = intPredicate( fn(int $x)=> $x>5)
                                ->and(intPredicate( fn(int $x)=> $x<15))
                                ->or(intPredicate(fn(int $x)=> $x === 18))
                                ->negate();
        
        $textPredicate = stringPredicate(fn(string $y)=> $y === 'Stefano')
                                ->and(stringPredicate(fn(string $y)=> strlen($y)===7))
                                ->or(stringPredicate(fn(string $y)=>$y==='Fago'));
        
     
        $compositePredicate = predicate( fn(IntHolder $x)=> $x->value>5)
                                ->and(predicate( fn(IntHolder $x)=> $x->value<15))
                                ->or(predicate( fn(IntHolder $x)=> $x===18 ))
                                ->negate();
        
        
        Sample::predicateResultForInt(11, $numPredicate);
        Sample::predicateResultForInt(16, $numPredicate);
        Sample::predicateResultForInt(18, $numPredicate);
        
        Sample::predicateResultForString('Pippo', $textPredicate);
        Sample::predicateResultForString('Stefano', $textPredicate);
        
        $holder = new IntHolder();
        $holder->value=11;
        Sample::predicateResultForObject($holder, $compositePredicate);
        
        $holder->value=18;
        Sample::predicateResultForObject($holder, $compositePredicate);
        
    }
}

Sample::Usage();
