<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Render\Common\Represent
 */
class MathOperator extends AbstractRepresent
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