<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Like
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class Like extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|LikeExpression $expression
     * @param RendererInterface                  $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%s LIKE %s',
            $renderer->render($expression->getLeft()),
            ($expression->isNot() ? ' NOT' : null),
            $renderer->render($expression->getRight()));
    }
    
}