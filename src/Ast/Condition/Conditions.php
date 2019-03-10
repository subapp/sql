<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ConverterInterface;

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
     * @param bool   $wrapped
     */
    public function __construct($expressions = [], $operator = LogicOperator:: AND, $wrapped = false)
    {
        parent::__construct($expressions);
        
        $this->setClass(NodeInterface::class);
        $this->setOperator($operator);
        $this->setWrapped($wrapped);
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
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_CONDITION_CONDITIONS;
    }
    
}