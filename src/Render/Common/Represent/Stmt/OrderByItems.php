<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\Common\Represent\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class OrderByItems
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * @param ExpressionInterface|ArgumentsExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->count() > 0 ? sprintf(' ORDER BY %s', parent::getSql($expression, $renderer)) : null;
    }
    
}