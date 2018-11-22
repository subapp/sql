<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Raw as RawExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Raw
 * @package Subapp\Sql\Converter\Common
 */
class Raw extends AbstractConverter
{
    
    /**
     * @param NodeInterface|RawExpression $node
     * @param RepresenterInterface                 $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return (string)$node->getExpression();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|RawExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['string' => $node->getExpression(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}