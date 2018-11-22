<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Collection as CollectionExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Converter\Common
 */
class Collection extends AbstractConverter
{

    /**
     * @param NodeInterface|CollectionExpression $collection
     * @param RepresenterInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, RepresenterInterface $renderer)
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
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
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
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        $ast = new \Subapp\Sql\Ast\Collection();
    }

}