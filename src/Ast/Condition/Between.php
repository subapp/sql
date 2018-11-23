<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Converter\ConverterInterface;

/**
 * Class Between
 * @package Subapp\Sql\Ast\Condition
 */
class Between extends AbstractIsNotPredicate
{
    
    /**
     * @var Literal
     */
    private $a;
    
    /**
     * @var Literal
     */
    private $b;
    
    /**
     * @return Literal
     */
    public function getA()
    {
        return $this->a;
    }
    
    /**
     * @param Literal $a
     */
    public function setA(Literal $a)
    {
        $this->a = $a;
    }
    
    /**
     * @return Literal
     */
    public function getB()
    {
        return $this->b;
    }
    
    /**
     * @param Literal $b
     */
    public function setB(Literal $b)
    {
        $this->b = $b;
    }
    
    /**
     * @return string
     */
    public function getConverter()
    {
        return ConverterInterface::CONVERTER_CONDITION_BETWEEN;
    }
    
}