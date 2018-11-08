<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class AbstractComparison
 * @package Subapp\Sql\Ast\Condition
 */
abstract class AbstractComparison extends AbstractExpression
{
    
    /**
     * @var ExpressionInterface
     */
    private $expressionA;
    
    /**
     * @var ExpressionInterface
     */
    private $expressionB;
    
    /**
     * AbstractComparison constructor.
     * @param ExpressionInterface $expressionA
     * @param ExpressionInterface $expressionB
     */
    public function __construct(ExpressionInterface $expressionA = null, ExpressionInterface $expressionB = null)
    {
        $this->expressionA = $expressionA;
        $this->expressionB = $expressionB;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getExpressionA()
    {
        return $this->expressionA;
    }
    
    /**
     * @param ExpressionInterface $expressionA
     */
    public function setExpressionA(ExpressionInterface $expressionA)
    {
        $this->expressionA = $expressionA;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getExpressionB()
    {
        return $this->expressionB;
    }
    
    /**
     * @param ExpressionInterface $expressionB
     */
    public function setExpressionB(ExpressionInterface $expressionB)
    {
        $this->expressionB = $expressionB;
    }
    
}