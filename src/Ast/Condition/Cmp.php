<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Ast\Condition
 */
class Cmp extends AbstractPredicate
{
    
    /**
     * @var Operator
     */
    private $operator;
    
    /**
     * Cmp constructor.
     * @param NodeInterface|null $left
     * @param Operator|null            $operator
     * @param NodeInterface|null $right
     */
    public function __construct(NodeInterface $left = null, Operator $operator = null, NodeInterface $right = null)
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
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_CONDITION_CMP;
    }
    
}