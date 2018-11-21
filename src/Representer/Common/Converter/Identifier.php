<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Representer\Common\Converter
 */
class Identifier extends AbstractConverter
{
    
    /**
     * @param NodeInterface|IdentifierExpression $node
     * @param RepresenterInterface                        $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return (string)$node->getIdentifier();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|IdentifierExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['identifier' => $node->getIdentifier(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {

    }
    
}