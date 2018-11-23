<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Converter\Common
 */
class FieldPath extends AbstractConverter
{
    
    /**
     * @param NodeInterface|FieldPathExpression $node
     * @param ProviderInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s.%s',
            $renderer->toSql($node->getTable()), $renderer->toSql($node->getField()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|FieldPathExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        return [
            'field' => $renderer->toArray($node->getField()),
            'table' => $renderer->toArray($node->getTable()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}