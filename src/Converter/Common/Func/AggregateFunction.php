<?php

namespace Subapp\Sql\Converter\Common\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Converter\Common\Func
 */
class AggregateFunction extends AbstractConverter
{

    /**
     * @param NodeInterface|AggregateFunctionExpression $node
     * @param ProviderInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        $distinct = $node->isDistinct() ? 'DISTINCT ' : null;
        $function = strtoupper($renderer->toSql($node->getFunctionName()));

        return sprintf('%s(%s%s)', $function, $distinct, $renderer->toSql($node->getArguments()));
    }

}