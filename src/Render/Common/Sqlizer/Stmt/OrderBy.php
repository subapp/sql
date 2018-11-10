<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByStmt;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class OrderBy extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|OrderByStmt $expression
     * @param RendererInterface               $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s %s', $renderer->render($expression->getExpression()), $expression->getDirection());
    }
    
}