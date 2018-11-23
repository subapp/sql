<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Collection as CollectionNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Converter\Common
 */
class Collection extends AbstractConverter
{

    /**
     * @param NodeInterface|CollectionNode $collection
     * @param ProviderInterface $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        $nodes = $collection->map(function (NodeInterface $inner) use ($provider) {
            return $provider->toSql($inner);
        });

        return implode($collection->getSeparator(), $nodes->toArray());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|CollectionNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $class = $node->getClass();
        $nodes = $node->map(function (NodeInterface $inner) use ($provider) {
            return $provider->toArray($inner);
        })->toArray();

        $array = parent::toArray($node, $provider);

        $array['class'] = $class;
        $array['nodes'] = $nodes;

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $collection = (new CollectionNode($ast['nodes']))->map(function ($node) use ($provider) {
            return $provider->toNode($node);
        });

        $collection->setClass($ast['class']);

        return $collection;
    }

}