<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Term
 * @package Subapp\Sql\Ast\Condition
 */
class Term extends AbstractExpression
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
     * @param string $operator
     */
    public function __construct($operator = null)
    {
        $this->operator = $operator;
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
    public function setOperator(LogicOperator $operator)
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
    public function getSqlizerName()
    {
        return 'condition.term';
    }
    
}