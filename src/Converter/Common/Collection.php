<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Collection as CollectionExpression;
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
     * @param NodeInterface|CollectionExpression $collection
     * @param ProviderInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $renderer)
    {
        $nodes = $collection->map(function (NodeInterface $inner) use ($renderer) {
            return $renderer->toSql($inner);
        });

        return implode($collection->getSeparator(), $nodes->toArray());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|CollectionExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        $class = $node->getClass();
        $nodes = $node->map(function (NodeInterface $inner) use ($renderer) {
            return $renderer->toArray($inner);
        })->toArray();

        $array = parent::toArray($node, $renderer);

        $array['class'] = $class;
        $array['nodes'] = $nodes;

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        $ast = new \Subapp\Sql\Ast\Collection();
    }

}