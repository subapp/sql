<?php

namespace Subapp\Sql\Ast\Condition;

/**
 * Class SimpleCmp
 * @package Subapp\Sql\Ast\Condition
 */
class Precedence extends AbstractComparison
{
    
    /**
     * @var Operator
     */
    private $operator;
    
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
    public function getSqlizerName()
    {
        return 'condition.simple_cmp';
    }
    
}