<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\From as FromExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class From
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class From extends AbstractSqlizer
{
    
    /**
     * @param RendererInterface   $renderer
     * @param ExpressionInterface|FromExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf(' FROM %s', $renderer->render($expression->getExpression()));
    }
    
}