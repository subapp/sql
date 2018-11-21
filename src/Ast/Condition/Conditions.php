<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Ast\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @var LogicOperator
     */
    private $operator;
    
    /**
     * TermCollection constructor.
     * @param array  $expressions
     * @param string $operator
     */
    public function __construct($expressions = [], $operator = LogicOperator::AND)
    {
        parent::__construct($expressions);
        
        $this->setClass(NodeInterface::class);
        $this->setOperator($operator);
    }
    
    /**
     * @return LogicOperator
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * @param string|LogicOperator $operator
     */
    public function setOperator($operator)
    {
        $this->operator = ($operator instanceOf LogicOperator) ? $operator : new LogicOperator($operator);
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'condition.conditions';
    }
    
}