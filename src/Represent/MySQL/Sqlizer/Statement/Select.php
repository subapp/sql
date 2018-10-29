<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer\Statement;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Statement\Select as SelectExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Represent\MySQL\Sqlizer\Statement
 */
class Select extends AbstractSqlizer
{
    
    /**
     * @param RendererInterface                                    $renderer
     * @param ExpressionInterface|SelectExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('SELECT %s %s',
            $renderer->render(
                $expression->getExpression()),
            $renderer->render($expression->getFrom()));
    }
    
}