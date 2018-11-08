<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Like
 * @package Subapp\Sql\Ast\Condition
 */
class Like extends AbstractComparison
{
    
    /**
     * @var boolean
     */
    private $isNot = false;
    
    /**
     * Like constructor.
     * @param boolean                  $isNot
     * @param ExpressionInterface|null $expressionA
     * @param ExpressionInterface|null $expressionB
     */
    public function __construct($isNot = false, ExpressionInterface $expressionA = null, ExpressionInterface $expressionB = null)
    {
        parent::__construct($expressionA, $expressionB);
        
        $this->isNot = $isNot;
    }
    
    /**
     * @return boolean
     */
    public function isNot()
    {
        return $this->isNot;
    }
    
    /**
     * @param bool $isNot
     */
    public function setIsNot($isNot)
    {
        $this->isNot = $isNot;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'condition.like';
    }
    
}