<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Statement\Select as SelectExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Render\Common\Sqlizer\Statement
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
        return sprintf('SELECT %s %s WHERE %s',
            $renderer->render($expression->getVariables()),
            $renderer->render($expression->getFrom()),
            $renderer->render($expression->getCondition())
        );
    }

}