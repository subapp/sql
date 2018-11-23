<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal as LiteralNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Literal
 * @package Subapp\Sql\Converter\Common
 */
class Literal extends AbstractConverter
{

    /**
     * @param NodeInterface|LiteralNode $node
     * @param ProviderInterface                     $provider
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $sql = null;

        switch (true) {
            case $node->getType() === LiteralNode::STRING:
                $sql = sprintf("'%s'", $node->getValue());
                break;

            case $node->getType() === LiteralNode::INT:
            case $node->getType() === LiteralNode::FLOAT:
                $sql = $node->getValue();
                break;

            case $node->getType() === LiteralNode::BOOLEAN:
                $sql = $node->getValue() ? 'TRUE' : 'FALSE';
                break;

            case $node->getType() === LiteralNode::NULL:
                $sql = 'NULL';
                break;

            default:
                throw new \InvalidArgumentException(
                    'Unable to render literal expression (%s) because it has unsupported type (%s)',
                        $node->getValue(), $node->getValue());
        }

        return $sql;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|LiteralNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['value'] = $node->getValue();
        $values['type'] = $node->getType();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new LiteralNode($ast['value'], $ast['type']);
    }

}