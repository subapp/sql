<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Like
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class Like extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|LikeExpression $node
     * @param RendererInterface                  $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s%s LIKE %s',
            $renderer->render($node->getLeft()),
            ($node->isNot() ? ' NOT' : null),
            $renderer->render($node->getRight()));
    }
    
}