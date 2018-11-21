<?php

namespace Subapp\Sql\Representer\Common\Converter\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Representer\Common\Converter\Func
 */
class AggregateFunction extends AbstractConverter
{

    /**
     * @param NodeInterface|AggregateFunctionExpression $node
     * @param RepresenterInterface $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        $distinct = $node->isDistinct() ? 'DISTINCT ' : null;
        $function = strtoupper($renderer->toSql($node->getFunctionName()));

        return sprintf('%s(%s%s)', $function, $distinct, $renderer->toSql($node->getArguments()));
    }

}