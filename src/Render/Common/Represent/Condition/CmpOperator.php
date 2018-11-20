<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class CmpOperator extends AbstractRepresent
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