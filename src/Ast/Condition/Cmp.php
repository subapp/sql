<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Ast\Condition
 */
class Cmp extends AbstractComparison
{
    
    /**
     * @var Operator
     */
    private $operator;
    
    /**
     * Cmp constructor.
     * @param ExpressionInterface|null $left
     * @param Operator|null            $operator
     * @param ExpressionInterface|null $right
     */
    public function __construct(ExpressionInterface $left = null, Operator $operator = null, ExpressionInterface $right = null)
    {
        parent::__construct($left, $right);
        
        $this->operator = $operator;
    }
    
    /**
     * @return Operator
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * @param Operator $operator
     */
    public function setOperator(Operator $operator)
    {
        $this->operator = $operator;
    }
    
    /**
     * @return string
     */
    public function getRendererName()
    {
        return 'condition.cmp';
    }
    
}