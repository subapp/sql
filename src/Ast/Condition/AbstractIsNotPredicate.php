<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\NodeInterface;

/**
 * Class AbstractIsNotComparison
 * @package Subapp\Sql\Ast\Condition
 */
abstract class AbstractIsNotPredicate extends AbstractPredicate
{
    
    /**
     * @var boolean
     */
    protected $isNot = false;
    
    /**
     * AbstractIsNotComparison constructor.
     * @param                     boolean $isNot
     * @param NodeInterface|null          $left
     * @param NodeInterface|null          $right
     */
    public function __construct($isNot = false, NodeInterface $left = null, NodeInterface $right = null)
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