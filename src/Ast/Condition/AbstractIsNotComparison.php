<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class AbstractIsNotComparison
 * @package Subapp\Sql\Ast\Condition
 */
abstract class AbstractIsNotComparison extends AbstractComparison
{
    
    /**
     * @var boolean
     */
    protected $isNot = false;
    
    /**
     * AbstractIsNotComparison constructor.
     * @param                     boolean $isNot
     * @param ExpressionInterface|null    $left
     * @param ExpressionInterface|null    $right
     */
    public function __construct($isNot = false, ExpressionInterface $left = null, ExpressionInterface $right = null)
    {
        parent::__construct($left, $right);
        
        $this->isNot = $isNot;
    }
    
    /**
     * @return bool
     */
    public function isNot()
    {
        return $this->isNot;
    }
    
    /**
     * @param bool $isNot
     */
    public function setIsNot($isNot)
    {
        $this->isNot = $isNot;
    }
    
}