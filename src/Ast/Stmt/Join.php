<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Join
 * @package Subapp\Sql\Ast
 */
class Join extends AbstractNode
{
    
    const INNER         = 'INNER';
    const LEFT          = 'LEFT';
    const RIGHT         = 'RIGHT';
    const CROSS         = 'CROSS';
    const STRAIGHT_JOIN = 'STRAIGHT_JOIN';
    
    const ON    = 'ON';
    const USING = 'USING';
    
    /**
     * @var NodeInterface
     */
    private $left;
    
    /**
     * @var NodeInterface
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
     * @return NodeInterface
     */
    public function getLeft()
    {
        return $this->left;
    }
    
    /**
     * @param NodeInterface $left
     */
    public function setLeft(NodeInterface $left)
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
     * @return NodeInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }
    
    /**
     * @param NodeInterface $collection
     */
    public function setCondition(NodeInterface $collection)
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
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_STMT_JOIN;
    }
    
}