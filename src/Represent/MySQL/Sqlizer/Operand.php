<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\Arithmetic;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Operand as OperandExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Operand
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class Operand extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|OperandExpression $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%s',
            $this->operator($expression->getOperator()),
            $this->operand($expression->getExpression(), $renderer)
        );
    }

    /**
     * @param $operator
     * @return null|string
     */
    private function operator($operator)
    {
        return $operator ? sprintf('%s ', $operator) : null;
    }

    /**
     * @param ExpressionInterface $expression
     * @param RendererInterface $renderer
     * @return string
     */
    private function operand(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf(($expression instanceof Arithmetic) ? '(%s)' : '%s', $renderer->render($expression));
    }
    
}