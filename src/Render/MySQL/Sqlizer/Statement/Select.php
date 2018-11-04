<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer\Statement;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Statement\Select as SelectExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Render\MySQL\Sqlizer\Statement
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
        return sprintf('SELECT %s %s',
            $renderer->render($expression->getVariables()),
            $renderer->render($expression->getFrom())
        );
    }

}