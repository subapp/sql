<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast;
use Subapp\Sql\Ast\Condition;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Exception\UnsupportedException;

/**
 * Class Node
 * @package Subapp\Sql\Query
 */
class Builder
{
    
    /**
     * @var Recognizer
     */
    private $recognizer;
    
    /**
     * Node constructor.
     * @param Recognizer $recognizer
     */
    public function __construct(Recognizer $recognizer = null)
    {
        $this->recognizer = $recognizer;
    }
    
    /**
     * @param $value
     * @return NodeInterface
     */
    public function recognize($value)
    {
        $node = new Ast\Raw(sprintf('[UNRECOGNIZED: "%s"]', is_object($value) ? get_class($value) : gettype($value)));
        
        switch (true) {
            case is_array($value):
                $node = $this->arguments(...array_map([$this, 'recognize'], $value));
                break;
            
            case is_string($value):
                switch (true) {
                    case preg_match('/^[\w\d_-]+\.[\w\d_-]+$/ui', $value):
                        list($table, $field) = explode('.', $value);
                        $node = $this->path($table, $field);
                        break;
                    default:
                        $node = $this->recognizer->recognize($value);
                }
                break;
            
            case ($value instanceOf NodeInterface):
            case is_null($value):
            case is_bool($value):
            case is_numeric($value):
                $node = $this->normalize($value);
                break;
        }
        
        return $node;
    }
    
    /**
     * @param $value
     * @return Ast\Identifier|NodeInterface
     * @throws UnsupportedException
     */
    public function normalize($value)
    {
        switch (true) {
            
            case is_array($value):
                return $this->arguments(...array_map([$this, 'normalize'], $value));
            
            case ($value instanceOf NodeInterface):
                return $value;
            
            case is_string($value):
                return $this->string($value);
            
            case is_null($value):
                return $this->null();
            
            case is_bool($value):
                return $this->boolean($value);
            
            case is_numeric($value):
                $type = (strpos($value, '.') !== false) ? Ast\Literal::FLOAT : Ast\Literal::INT;
                return $this->literal($value, $type);
            
            default:
                throw new UnsupportedException(sprintf('Unexpected case of normalizing value. Expect only scalar but "%s" passed',
                    is_object($value) ? get_class($value) : gettype($value)));
        }
    }
    
    /**
     * @param                         $operator
     * @param Ast\NodeInterface       ...$predicates
     * @return Condition\Conditions
     */
    public function conditions($operator, ...$predicates)
    {
        $collection = new Condition\Conditions([], $operator);
        
        foreach ($predicates as $predicate) {
            $collection->append($this->recognize($predicate));
        }
        
        $collection->setWrapped($collection->count() > 1);
        
        return $collection;
    }
    
    /**
     * (Condition AND Condition)
     *
     * @param Ast\NodeInterface ...$terms
     * @return Condition\Conditions
     */
    public function and(...$terms)
    {
        return $this->conditions(Condition\LogicOperator:: AND, ...$terms);
    }
    
    /**
     * @param Ast\NodeInterface ...$terms
     * @return Condition\Conditions
     */
    public function or(...$terms)
    {
        return $this->conditions(Condition\LogicOperator:: OR, ...$terms);
    }
    
    /**
     * @param Ast\NodeInterface ...$terms
     * @return Condition\Conditions
     */
    public function xor(...$terms)
    {
        return $this->conditions(Condition\LogicOperator:: XOR, ...$terms);
    }
    
    /**
     * (Expression ComparisonOperator Expression)
     *
     * @param $x
     * @param $operator
     * @param $y
     * @return Condition\Cmp
     */
    public function comparison($x, $operator, $y)
    {
        return new Condition\Cmp($this->recognize($x), $this->cmp($operator), $this->normalize($y));
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function eq($x, $y)
    {
        return $this->comparison($x, Condition\Operator::EQ, $y);
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function ne($x, $y)
    {
        return $this->comparison($x, Condition\Operator::NE, $y);
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function gt($x, $y)
    {
        return $this->comparison($x, Condition\Operator::GT, $y);
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function ge($x, $y)
    {
        return $this->comparison($x, Condition\Operator::GE, $y);
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function lt($x, $y)
    {
        return $this->comparison($x, Condition\Operator::LT, $y);
    }
    
    /**
     * @param $x
     * @param $y
     * @return Condition\Cmp
     */
    public function le($x, $y)
    {
        return $this->comparison($x, Condition\Operator::LE, $y);
    }
    
    /**
     * @param         $x
     * @param         $in
     * @param boolean $not
     * @return Condition\In
     */
    public function in($x, $in, $not = false)
    {
        return new Condition\In($not, $this->recognize($x), $this->recognize($in));
    }
    
    /**
     * @param         $x
     * @param boolean $not
     * @return Condition\IsNull
     */
    public function isNull($x, $not = false)
    {
        return new Condition\IsNull($not, $this->recognize($x));
    }
    
    /**
     * @param         $left
     * @param string  $a
     * @param string  $b
     * @param boolean $not
     * @return Condition\Between
     */
    public function between($left, $a, $b, $not = false)
    {
        $between = new Condition\Between(false, $this->recognize($left));
        
        $between->setIsNot($not);
        $between->setA($this->string($a));
        $between->setB($this->string($b));
        
        return $between;
    }
    
    /**
     * @param         $left
     * @param         $match
     * @param boolean $not
     * @return Condition\Like
     */
    public function like($left, $match, $not = false)
    {
        $like = new Condition\Like($not);
        
        $like->setLeft($this->recognize($left));
        $like->setRight($this->string($match));
        
        return $like;
    }
    
    /**
     * @param string $field
     * @param bool   $quote
     * @return Ast\Identifier
     */
    public function field($field, $quote = false)
    {
        return $this->identifier($field, $quote);
    }
    
    /**
     * @param string $table
     * @param bool   $quote
     * @return Ast\Identifier
     */
    public function table($table, $quote = false)
    {
        return $this->identifier($table, $quote);
    }
    
    /**
     * @param $table
     * @param $field
     * @return Ast\FieldPath
     */
    public function path($table, $field)
    {
        // table unquoted 'cause maybe be aliased
        return new Ast\FieldPath($this->table($table, false), $this->field($field, true));
    }
    
    /**
     * @param NodeInterface ...$values
     * @return Ast\Arguments
     */
    public function arguments(...$values)
    {
        return new Ast\Arguments($values);
    }
    
    /**
     * @param string|NodeInterface $var
     * @param null                 $alias
     * @return Ast\Variable
     */
    public function variable($var, $alias = null)
    {
        $variable = new Ast\Variable($this->recognize($var));
        
        if ($alias !== null) {
            $variable->setAlias(new Ast\Identifier($alias));
        }
        
        return $variable;
    }
    
    /**
     * @param string|NodeInterface $left
     * @param string|NodeInterface $value
     * @return Ast\Stmt\Assignment
     */
    public function assignment($left, $value)
    {
        return new Ast\Stmt\Assignment(
            $this->field($left), $this->normalize($value)
        );
    }
    
    /**
     * @param string $value
     * @param int    $type
     * @return Ast\Literal
     */
    public function literal($value, $type = Ast\Literal::STRING)
    {
        return new Ast\Literal($value, $type);
    }
    
    /**
     * @param string $value
     * @return Ast\Literal
     */
    public function string($value)
    {
        return $this->literal($value);
    }
    
    /**
     * @param $value
     * @return Ast\Literal
     */
    public function float($value)
    {
        return $this->literal((float)$value, Ast\Literal::FLOAT);
    }
    
    /**
     * @param $value
     * @return Ast\Literal
     */
    public function int($value)
    {
        return $this->literal((integer)$value, Ast\Literal::INT);
    }
    
    /**
     * @param boolean $value
     * @return Ast\Literal
     */
    public function boolean($value)
    {
        return $this->literal((boolean)$value, Ast\Literal::BOOLEAN);
    }
    
    /**
     * @return Ast\Literal
     */
    public function true()
    {
        return $this->boolean(true);
    }
    
    /**
     * @return Ast\Literal
     */
    public function false()
    {
        return $this->boolean(false);
    }
    
    /**
     * @return Ast\Literal
     */
    public function null()
    {
        return $this->literal(null, Ast\Literal::NULL);
    }
    
    /**
     * @param string $identifier
     * @param bool   $quoted
     * @return Ast\Identifier
     */
    public function identifier($identifier, $quoted = false)
    {
        return !$quoted ? new Ast\Identifier($identifier) : new Ast\QuoteIdentifier($identifier);
    }
    
    /**
     * @param string $name
     * @return Ast\Parameter
     */
    public function named($name)
    {
        return new Ast\Parameter(Ast\Parameter::NAMED, $name);
    }
    
    /**
     * @return Ast\Parameter
     */
    public function unnamed()
    {
        return new Ast\Parameter();
    }
    
    /**
     * @param $x
     * @param $operator
     * @param $y
     * @return Ast\Arithmetic
     */
    public function arithmetic($x, $operator, $y)
    {
        $arithmetic = new Ast\Arithmetic();
        
        $arithmetic->append($this->recognize($x));
        $arithmetic->append($this->math($operator));
        $arithmetic->append($this->recognize($y));
        
        return $arithmetic;
    }
    
    /**
     * @param string $operator
     * @return Condition\Operator
     */
    public function cmp($operator)
    {
        return new Condition\Operator($operator);
    }
    
    /**
     * @param string $operator
     * @return Condition\LogicOperator
     */
    public function logic($operator)
    {
        return new Condition\LogicOperator($operator);
    }
    
    /**
     * @param $operator
     * @return Ast\MathOperator
     */
    public function math($operator)
    {
        return new Ast\MathOperator($operator);
    }
    
    /**
     * @param string $string
     * @return Ast\Raw
     */
    public function raw($string)
    {
        return new Ast\Raw($string);
    }
    
    /**
     * @param string $string
     * @return Ast\NodeInterface
     */
    public function sql($string)
    {
        return $this->recognizer->recognize($string);
    }
    
    /**
     * @return Recognizer
     */
    public function getRecognizer()
    {
        return $this->recognizer;
    }
    
    /**
     * @param Recognizer $recognizer
     */
    public function setRecognizer(Recognizer $recognizer)
    {
        $this->recognizer = $recognizer;
    }
    
}