<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Render\Common\Represent
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('`%s`', parent::getSql($node->getIdentifier(), $renderer));
    }
    
}