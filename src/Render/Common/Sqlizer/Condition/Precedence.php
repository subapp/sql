<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Precedence as PrecedenceExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Precedence
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class Precedence extends AbstractSqlizer
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