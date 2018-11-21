<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\Common\Represent\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class OrderByItems
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * @param NodeInterface|ArgumentsExpression $node
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' ORDER BY %s', parent::getSql($node, $renderer)) : null;
    }
    
}