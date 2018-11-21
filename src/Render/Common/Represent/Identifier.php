<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Render\Common\Represent
 */
class Identifier extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return (string)$node->getIdentifier();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['identifier' => $node->getIdentifier(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {

    }
    
}