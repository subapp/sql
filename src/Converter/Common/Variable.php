<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Variable as VariableExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Converter\Common
 */
class Variable extends AbstractConverter
{

    /**
     * @param NodeInterface|VariableExpression $node
     * @param RepresenterInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s%s',
            $renderer->toSql($node->getExpression()),
            ($node->getAlias() ? sprintf(' AS %s', $renderer->toSql($node->getAlias())) : null)
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|VariableExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return [
            'expression' => $renderer->toArray($node->getExpression()),
            'alias' => ($node->getAlias() ? $renderer->toArray($node->getAlias()) : null)
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