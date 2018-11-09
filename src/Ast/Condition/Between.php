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
    private $betweenA;
    
    /**
     * @var Literal
     */
    private $betweenB;
    
    /**
     * @return Literal
     */
    public function getBetweenA()
    {
        return $this->betweenA;
    }
    
    /**
     * @param Literal $betweenA
     */
    public function setBetweenA(Literal $betweenA)
    {
        $this->betweenA = $betweenA;
    }
    
    /**
     * @return Literal
     */
    public function getBetweenB()
    {
        return $this->betweenB;
    }
    
    /**
     * @param Literal $betweenB
     */
    public function setBetweenB(Literal $betweenB)
    {
        $this->betweenB = $betweenB;
    }
    
    /**
     * @return string
     */
    public function getSqlizerName()
    {
        return 'condition.between';
    }
    
}