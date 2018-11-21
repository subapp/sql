<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Render\Common\Represent\Condition\Conditions;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Where
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Where extends Conditions
{
    
    /**
     * @param NodeInterface|WhereExpression $node
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return $node->isNotEmpty() ? sprintf(' WHERE %s', parent::getSql($node, $renderer)) : null;
    }
    
}