<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Variable as VariableExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Variable extends AbstractSqlizer
{

    /**
     * @param ExpressionInterface|VariableExpression $expression
     * @param RendererInterface                                 $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%s',
            $renderer->render($expression->getExpression()),
            ($expression->getAlias() ? sprintf(' AS %s', $renderer->render($expression->getAlias())) : null)
        );
    }

}