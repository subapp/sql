<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\Literal;

/**
 * Class Between
 * @package Subapp\Sql\Ast\Condition
 */
class Between extends AbstractIsNotComparison
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
    public function getRenderer()
    {
        return 'condition.between';
    }
    
}