<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class Cmp extends AbstractRepresent
{
    
    /**
     * @param ExpressionInterface|PrecedenceExpression $expression
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s %s %s',
            $renderer->render($expression->getLeft()),
            $renderer->render($expression->getOperator()),
            $renderer->render($expression->getRight()));
    }
    
}