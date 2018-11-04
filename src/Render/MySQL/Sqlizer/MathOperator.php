<?php

namespace Subapp\Sql\Render\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Render\MySQL\Sqlizer
 */
class MathOperator extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|MathOperatorExpression $expression
     * @param RendererInterface                          $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->getOperator();
    }
    
}