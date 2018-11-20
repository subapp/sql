<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByStmt;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class OrderBy extends AbstractRepresent
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