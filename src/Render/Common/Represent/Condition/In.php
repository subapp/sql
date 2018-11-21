<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\In as InExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class In
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class In extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|InExpression $node
     * @param RendererInterface                $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s%sIN(%s)',
            $renderer->render($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->render($node->getRight()));
    }
    
}