<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Raw as RawNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Raw
 * @package Subapp\Sql\Converter\Common
 */
class Raw extends AbstractConverter
{
    
    /**
     * @param NodeInterface|RawNode $node
     * @param ProviderInterface                 $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return (string)$node->getExpression();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|RawNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        return ['string' => $node->getExpression(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new RawNode($ast['string']);
    }

}