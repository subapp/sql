<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Raw as RawExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Raw
 * @package Subapp\Sql\Converter\Common
 */
class Raw extends AbstractConverter
{
    
    /**
     * @param NodeInterface|RawExpression $node
     * @param ProviderInterface                 $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return (string)$node->getExpression();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|RawExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        return ['string' => $node->getExpression(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}