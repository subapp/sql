<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Select extends AbstractRepresent
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
            $renderer->render($expression->getHaving()),
            $renderer->render($expression->getOrderBy()),
            $renderer->render($expression->getLimit()),
            $expression->isSemicolon() ? "\n;" : null
        );
    }

}