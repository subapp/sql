<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Render\MySQL\Sqlizer
 */
class Arithmetic extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|ArithmeticExpression $expression
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $pieces = [];

        foreach ($expression->getCollection() as $expression) {
            $pieces[] = $renderer->render($expression);
        }

        return implode(' ', $pieces);
    }
    
}