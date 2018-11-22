<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal as LiteralExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Literal
 * @package Subapp\Sql\Converter\Common
 */
class Literal extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LiteralExpression $node
     * @param RepresenterInterface                     $renderer
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
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
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['value' => $node->getValue(), 'type' => $node->getType(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}