<?php

namespace Subapp\Sql\Ast\Stmt;

use Subapp\Sql\Ast\AbstractNode;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Ast
 */
class OrderBy extends AbstractNode
{
    
    const ASC   = 'ASC';
    const DESC  = 'DESC';
    
    /**
     * @var string
     */
    private $direction;
    
    /**
     * @var NodeInterface
     */
    private $expression;
    
    /**
     * OrderBy constructor.
     *
     * @param NodeInterface $expression
     * @param string              $direction
     */
    public function __construct(NodeInterface $expression = null, $direction = OrderBy::ASC)
    {
        $this->expression = $expression;
        $this->direction = $direction;
    }
    
    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }
    
    /**
     * @param string $direction
     */
    public function setDirection(string $direction)
    {
        $this->direction = $direction;
    }
    
    /**
     * @return NodeInterface
     */
    public function getExpression()
    {
        return $this->expression;
    }
    
    /**
     * @param NodeInterface $expression
     */
    public function setExpression(NodeInterface $expression)
    {
        $this->expression = $expression;
    }
    
    /**
     * @return string
     */
    public function getRenderer()
    {
        return 'stmt.order_by';
    }
    
}