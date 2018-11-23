<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Variable as VariableExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Converter\Common
 */
class Variable extends AbstractConverter
{

    /**
     * @param NodeInterface|VariableExpression $node
     * @param ProviderInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
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
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        return [
            'expression' => $renderer->toArray($node->getExpression()),
            'alias' => ($node->getAlias() ? $renderer->toArray($node->getAlias()) : null)
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