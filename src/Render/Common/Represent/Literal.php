<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal as LiteralExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Literal
 * @package Subapp\Sql\Render\Common\Represent
 */
class Literal extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|LiteralExpression $node
     * @param RendererInterface                     $renderer
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        $sql = null;

        switch (true) {
            case $node->getType() === LiteralExpression::STRING:
                $sql = sprintf("'%s'", $node->getValue()); break;
            case $node->getType() === LiteralExpression::INT:
            case $node->getType() === LiteralExpression::FLOAT:
                $sql = $node->getValue(); break;
            case $node->getType() === LiteralExpression::BOOLEAN:
                $sql = $node->getValue() ? 'TRUE' : 'FALSE'; break;
            case $node->getType() === LiteralExpression::NULL:
                $sql = 'NULL'; break;
            default:
                throw new \InvalidArgumentException('Unable to render literal expression (%s) because it has unsupported type (%s)',
                    $node->getValue(), $node->getValue());
        }

        return $sql;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|LiteralExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['value' => $node->getValue(), 'type' => $node->getType(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}