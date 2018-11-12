<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Between
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class Between extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|BetweenExpression $expression
     * @param RendererInterface                     $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $renderer->render($expression->getLeft()),
            ($expression->isNot() ? ' NOT ' : ' '),
            $renderer->render($expression->getA()),
            $renderer->render($expression->getB()));
    }
    
}