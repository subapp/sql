<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractExpression;

/**
 * Class Term
 * @package Subapp\Sql\Ast\Condition
 */
class Term extends AbstractExpression
{
    
    const AND = 'AND';
    const OR = 'OR';
    const XOR = 'XOR';
    
    /**
     * @var string
     */
    private $operator;
    
    /**
     * Term constructor.
     * @param string $operator
     */
    public function __construct($operator)
    {
        $this->operator = $operator;
    }
    
    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }
    
    /**
     * @param string $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'condition.term';
    }
    
}