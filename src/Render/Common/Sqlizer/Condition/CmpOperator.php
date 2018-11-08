<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class CmpOperator extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|CmpOperatorExpression $expression
     * @param RendererInterface                         $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return (string)$expression->getOperator();
    }
    
}