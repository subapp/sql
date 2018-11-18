<?php

namespace Subapp\Sql\Ast\Condition;

use Subapp\Sql\Ast\AbstractExpression;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class AbstractPredicate
 * @package Subapp\Sql\Ast\Condition
 */
abstract class AbstractPredicate extends AbstractExpression
{
    
    /**
     * @var ExpressionInterface
     */
    private $left;
    
    /**
     * @var ExpressionInterface
     */
    private $right;
    
    /**
     * AbstractComparison constructor.
     * @param ExpressionInterface $left
     * @param ExpressionInterface $right
     */
    public function __construct(ExpressionInterface $left = null, ExpressionInterface $right = null)
    {
        $this->left     = $left;
        $this->right    = $right;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getLeft()
    {
        return $this->left;
    }
    
    /**
     * @param ExpressionInterface $left
     */
    public function setLeft(ExpressionInterface $left)
    {
        $this->left = $left;
    }
    
    /**
     * @return ExpressionInterface
     */
    public function getRight()
    {
        return $this->right;
    }
    
    /**
     * @param ExpressionInterface $right
     */
    public function setRight(ExpressionInterface $right)
    {
        $this->right = $right;
    }
    
}