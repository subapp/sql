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
class Node
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
     * @param $sql
     * @return NodeInterface
     * @throws UnsupportedException
     */
    public function recognize($sql)
    {
        switch (true) {
            case ($sql instanceOf NodeInterface):
                return $sql;
            
            case is_null($sql):
                return $this->null();
            
            case is_bool($sql):
                return $this->boolean($sql);
            
            case is_numeric($sql):
                $isFloat = (strpos($sql, '.') !== false);
                return $this->literal($sql, $isFloat ? Ast\Literal::FLOAT : Ast\Literal::INT);
            
            case is_string($sql) && preg_match('/^[\w\d]+$/i', $sql):
                return $this->identifier($sql);
            
            case is_array($sql):
                return $this->arguments(...array_map([$this, 'recognize'], $sql));
            
            case is_object($sql):
                throw new UnsupportedException(sprintf('Object recognizing able only for "%s" but "%s" passed',
                    NodeInterface::class, get_class($sql)));
            
            default:
                return $this->recognizer->recognize($sql);
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
        return new Condition\Cmp($this->recognize($x), $this->cmp($operator), $this->recognize($y));
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
     * @return Ast\Identifier
     */
    public function field($field)
    {
        return $this->identifier($field);
    }
    
    /**
     * @param string $table
     * @return Ast\Identifier
     */
    public function table($table)
    {
        return $this->identifier($table);
    }
    
    /**
     * @param $table
     * @param $field
     * @return Ast\FieldPath
     */
    public function path($table, $field)
    {
        return new Ast\FieldPath($this->table($table), $this->field($field));
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
            $this->recognize($left), $this->recognize($value)
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
     * @return Ast\Identifier
     */
    public function identifier($identifier)
    {
        return new Ast\Identifier($identifier);
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
     * @param $string
     * @return Ast\Raw
     */
    public function raw($string)
    {
        return new Ast\Raw($string);
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