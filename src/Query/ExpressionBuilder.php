<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast\Condition;
use Subapp\Sql\Ast;

/**
 * Class ExpressionBuilder
 * @package Subapp\Sql\Query
 */
class ExpressionBuilder
{
    
    /**
     * @param                         $operator
     * @param Ast\ExpressionInterface ...$terms
     * @return Condition\TermCollection
     */
    public function terms($operator, ...$terms)
    {
        $collection = new Condition\TermCollection();
        $operator = $this->logic($operator);
        
        foreach ($terms as $term) {
            $collection->append(new Condition\Term($operator, $term));
        }
        
        /** @var Condition\Term $last */
        $last = $collection->get($collection->count() - 1);
        $last->setOperator(null);
        
        return $collection;
    }
    
    /**
     * @param Ast\ExpressionInterface ...$terms
     * @return Condition\TermCollection
     */
    public function and(...$terms)
    {
        return $this->terms(Condition\LogicOperator:: AND, ...$terms);
    }
    
    /**
     * @param Ast\ExpressionInterface ...$terms
     * @return Condition\TermCollection
     */
    public function or(...$terms)
    {
        return $this->terms(Condition\LogicOperator:: OR, ...$terms);
    }
    
    /**
     * @param Ast\ExpressionInterface ...$terms
     * @return Condition\TermCollection
     */
    public function xor(...$terms)
    {
        return $this->terms(Condition\LogicOperator:: XOR, ...$terms);
    }
    
    public function eq($x, $y)
    {
        return new Condition\Cmp(
            is_scalar($x) ? $this->literal($x) : $x,
            $this->cmp(Condition\Operator::EQ),
            is_scalar($y) ? $this->literal($y) : $y
        );
    }
    
    public function ne($x, $y)
    {
    
    }
    
    public function gt($x, $y)
    {
    
    }
    
    public function ge($x, $y)
    {
    
    }
    
    public function lt($x, $y)
    {
    
    }
    
    public function le($x, $y)
    {
    
    }
    
    public function in($x, $in, $not = false)
    {
    
    }
    
    public function isNull($x, $not = false)
    {
    
    }
    
    /**
     * @param        $left
     * @param string $a
     * @param string $b
     * @return Condition\Between
     */
    public function between($left, $a, $b)
    {
        $between = new Condition\Between(false, $left);
        
        $between->setBetweenA($this->literal($a));
        $between->setBetweenB($this->literal($b));
        
        return $between;
    }
    
    /**
     * @param string $table
     * @param string $field
     * @return Ast\FieldPath
     */
    public function field($table, $field)
    {
        return new Ast\FieldPath($this->identifier($table), $this->identifier($field));
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
     * @return Ast\Literal
     */
    public function true()
    {
        return $this->literal(true, Ast\Literal::BOOLEAN);
    }
    
    /**
     * @return Ast\Literal
     */
    public function false()
    {
        return $this->literal(false, Ast\Literal::BOOLEAN);
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
     * @param $x
     * @param $operator
     * @param $y
     * @return Ast\Arithmetic
     */
    public function arithmetic($x, $operator, $y)
    {
        $arithmetic = new Ast\Arithmetic();
    
        $arithmetic->append($this->int($x));
        $arithmetic->append($this->math($operator));
        $arithmetic->append($this->int($y));
        
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
    
    public function isLiteral($value)
    {
    
    }
    
    /**
     * @param $expression
     * @return boolean
     */
    public function isExpression($expression)
    {
        return ($expression instanceof Ast\ExpressionInterface);
    }
    
}