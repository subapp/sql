<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
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
        $operands = [];

        foreach ($expression->getOperands() as $operand) {
            $operands[] = $renderer->render($operand);
        }

        return implode(' ', $operands);
    }
    
}