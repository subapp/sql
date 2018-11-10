<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class SelectStatement extends AbstractSqlizer
{

    /**
     * @param RendererInterface $renderer
     * @param ExpressionInterface|SelectExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf("SELECT %s \n%s%s%s%s%s%s",
            $renderer->render($expression->getArguments()),
            $renderer->render($expression->getFrom()),
            ($joins = $renderer->render($expression->getJoins())) ? sprintf("\n%s", $joins) : null,
            ($where = $renderer->render($expression->getWhere())) ? sprintf("\n%s", $where) : null,
            ($group = $renderer->render($expression->getGroupBy())) ? sprintf("\n%s", $group) : null,
            ($order = $renderer->render($expression->getOrderBy())) ? sprintf("\n%s", $order) : null,
            ($limit = $renderer->render($expression->getLimit())) ? sprintf("\n%s", $limit) : null
        );
    }

}