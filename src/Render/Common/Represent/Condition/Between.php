<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Between
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class Between extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|BetweenExpression $node
     * @param RendererInterface                     $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $renderer->render($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->render($node->getA()),
            $renderer->render($node->getB()));
    }
    
}