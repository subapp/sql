<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Join as JoinExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Join
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class Join extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|JoinExpression $expression
     * @param RendererInterface                  $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s JOIN %s %s (%s)',
            $expression->getJoinType(),
            $renderer->render($expression->getLeft()),
            $expression->getConditionType(),
            $renderer->render($expression->getCondition())
        );
    }
    
}