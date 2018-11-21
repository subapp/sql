<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByExpression;
use Subapp\Sql\Render\Common\Represent\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class GroupBy extends Arguments
{
    
    /**
     * @param NodeInterface|GroupByExpression $node
     * @param RendererInterface                     $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' GROUP BY %s', parent::getSql($node, $renderer)) : null;
    }

}