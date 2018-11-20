<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class LogicOperator extends AbstractRepresent
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