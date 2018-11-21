<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\From as FromExpression;
use Subapp\Sql\Render\Common\Represent\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class From
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class From extends Arguments
{
    
    /**
     * @param RendererInterface   $renderer
     * @param NodeInterface|FromExpression $node
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf(' FROM %s', parent::getSql($node, $renderer));
    }

}