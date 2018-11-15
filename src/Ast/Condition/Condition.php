<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Condition
 * @package Subapp\Sql\Ast\Condition
 */
class Condition extends AbstractExpression
{
    
    /**
     * @var LogicOperator
     */
    private $operator;
    
    /**
     * @var ExpressionInterface
     */
    private $expression;
    
    /**
     * Term constructor.
     * @param string                   $operator
     * @param ExpressionInterface|null $expression
     */
    public function __construct($operator = null, ExpressionInterface $expression = null)
    {
        $this->operator = $operator;
        $this->expression = $expression;
    }
    
    /**
     * @return LogicOperator
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * @param LogicOperator $operator
     */
    public function setOperator(LogicOperator $operator = null)
    {
        $this->operator = $operator;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getExpression()
    {
        return $this->expression;
    }
    
    /**
     * @param ExpressionInterface $expression
     */
    public function setExpression(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'condition.term';
    }
    
}