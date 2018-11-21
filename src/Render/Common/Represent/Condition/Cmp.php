<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class Cmp extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|PrecedenceExpression $node
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s %s %s',
            $renderer->render($node->getLeft()),
            $renderer->render($node->getOperator()),
            $renderer->render($node->getRight()));
    }
    
}