<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Join
 * @package Subapp\Sql\Ast
 */
class Join extends AbstractExpression
{
    
    const INNER         = 'INNER';
    const LEFT          = 'LEFT';
    const RIGHT         = 'RIGHT';
    const CROSS         = 'CROSS';
    const STRAIGHT_JOIN = 'STRAIGHT_JOIN';
    
    const ON    = 'ON';
    const USING = 'USING';
    
    /**
     * @var ExpressionInterface
     */
    private $left;
    
    /**
     * @var ExpressionInterface
     */
    private $condition;
    
    /**
     * @var string
     */
    private $conditionType;
    
    /**
     * @var string
     */
    private $joinType;
    
    /**
     * Join constructor.
     * @param string $joinType
     */
    public function __construct($joinType = Join::INNER)
    {
        $this->joinType = $joinType;
        $this->conditionType = Join::ON;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getLeft()
    {
        return $this->left;
    }
    
    /**
     * @param ExpressionInterface $left
     */
    public function setLeft(ExpressionInterface $left)
    {
        $this->left = $left;
    }
    
    /**
     * @return string
     */
    public function getJoinType()
    {
        return $this->joinType;
    }
    
    /**
     * @param string $joinType
     */
    public function setJoinType($joinType)
    {
        $this->joinType = $joinType;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * @param ExpressionInterface $collection
     */
    public function setCondition(ExpressionInterface $collection)
    {
        $this->condition = $collection;
    }
    
    /**
     * @return string
     */
    public function getConditionType()
    {
        return $this->conditionType;
    }
    
    /**
     * @param string $conditionType
     */
    public function setConditionType($conditionType)
    {
        $this->conditionType = $conditionType;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'stmt.join';
    }
    
}