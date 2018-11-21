<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Collection as CollectionExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Render\Common\Represent
 */
class Collection extends AbstractRepresent
{

    /**
     * @param NodeInterface|CollectionExpression $collection
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(NodeInterface $collection, RendererInterface $renderer)
    {
        $nodes = $collection->map(function (NodeInterface $inner) use ($renderer) {
            return $renderer->render($inner);
        });

        return implode($collection->getSeparator(), $nodes->toArray());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|CollectionExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        $nodes = $node->map(function (NodeInterface $inner) use ($renderer) {
            return $renderer->toArray($inner);
        });

        $array = parent::toArray($node, $renderer);

        $array['nodes'] = $nodes->toArray();

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        $values = new \Subapp\Sql\Ast\Collection();
    }

}