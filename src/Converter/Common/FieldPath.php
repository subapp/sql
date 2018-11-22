<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Converter\Common
 */
class FieldPath extends AbstractConverter
{
    
    /**
     * @param NodeInterface|FieldPathExpression $node
     * @param RepresenterInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s.%s',
            $renderer->toSql($node->getTable()), $renderer->toSql($node->getField()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|FieldPathExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return [
            'field' => $renderer->toArray($node->getField()),
            'table' => $renderer->toArray($node->getTable()),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}