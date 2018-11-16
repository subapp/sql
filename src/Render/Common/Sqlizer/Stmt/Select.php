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
class Select extends AbstractSqlizer
{

    /**
     * @param RendererInterface $renderer
     * @param ExpressionInterface|SelectExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf("SELECT %s%s%s%s%s%s%s%s",
            $renderer->render($expression->getArguments()),
            $renderer->render($expression->getFrom()),
            $renderer->render($expression->getJoins()),
            $renderer->render($expression->getWhere()),
            $renderer->render($expression->getGroupBy()),
            $renderer->render($expression->getOrderBy()),
            $renderer->render($expression->getLimit()),
            $expression->isSemicolon() ? "\n;" : null
        );
    }

}