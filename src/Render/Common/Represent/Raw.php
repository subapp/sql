<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Raw as RawExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Raw
 * @package Subapp\Sql\Render\Common\Represent
 */
class Raw extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|RawExpression $node
     * @param RendererInterface                 $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return (string)$node->getExpression();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|RawExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['string' => $node->getExpression(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}