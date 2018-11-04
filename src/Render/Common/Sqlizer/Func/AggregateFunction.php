<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Func;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Render\Common\Sqlizer\Func
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