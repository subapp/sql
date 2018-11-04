<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\Alias as AliasExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Alias
 * @package Subapp\Sql\Render\MySQL\Sqlizer
 */
class Alias extends AbstractSqlizer
{

    /**
     * @param ExpressionInterface|AliasExpression $expression
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s AS %s',
            $renderer->render($expression->getExpression()), $renderer->render($expression->getAlias()));
    }

}