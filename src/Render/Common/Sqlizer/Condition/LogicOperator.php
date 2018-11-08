<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class LogicOperator extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|LogicOperatorExpression $expression
     * @param RendererInterface                           $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return (string)$expression->getOperator();
    }
    
}