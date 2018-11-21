<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Embrace
 * @package Subapp\Sql\Render\Common\Represent
 */
class Embrace extends AbstractRepresent
{

    /**
     * @param NodeInterface|EmbraceExpression $node
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        $template = ($node->getInner() instanceof Select) ? '(%s)' : '%s';
        
        return sprintf($template, $renderer->render($node->getInner()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|EmbraceExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['inner' => $renderer->toArray($node->getInner()),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}