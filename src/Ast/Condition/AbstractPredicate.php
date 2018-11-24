<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class AbstractPredicate
 * @package Subapp\Sql\Ast\Condition
 */
abstract class AbstractPredicate extends AbstractNode
{
    
    /**
     * @var NodeInterface
     */
    private $left;
    
    /**
     * @var NodeInterface
     */
    private $right;
    
    /**
     * AbstractComparison constructor.
     * @param NodeInterface $left
     * @param NodeInterface $right
     */
    public function __construct(NodeInterface $left = null, NodeInterface $right = null)
    {
        $this->left = $left;
        $this->right = $right;
    }
    
    /**
     * @return NodeInterface
     */
    public function getLeft()
    {
        return $this->left;
    }
    
    /**
     * @param NodeInterface $left
     */
    public function setLeft(NodeInterface $left)
    {
        $this->left = $left;
    }
    
    /**
     * @return NodeInterface
     */
    public function getRight()
    {
        return $this->right;
    }
    
    /**
     * @param NodeInterface $right
     */
    public function setRight(NodeInterface $right)
    {
        $this->right = $right;
    }
    
}