<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class QuoteIdentifier
 * @package Subapp\Sql\Representer\Common\Converter
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param RepresenterInterface   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('`%s`', parent::toSql($node->getIdentifier(), $renderer));
    }
    
}