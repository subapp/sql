<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer\Func;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Represent\MySQL\Sqlizer\Func
 */
class AggregateFunction extends AbstractSqlizer
{

    /**
     * @param ExpressionInterface|AggregateFunctionExpression $expression
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $distinct = $expression->isDistinct() ? 'DISTINCT ' : null;
        $function = strtoupper($renderer->render($expression->getFunctionName()));

        return sprintf('%s(%s%s)', $function, $distinct, $renderer->render($expression->getArguments()));
    }

}