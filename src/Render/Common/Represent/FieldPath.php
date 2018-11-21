<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Render\Common\Represent
 */
class FieldPath extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|FieldPathExpression $node
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s.%s',
            $renderer->render($node->getTable()), $renderer->render($node->getField()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|FieldPathExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return [
            'field' => $renderer->toArray($node->getField()),
            'table' => $renderer->toArray($node->getTable()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}