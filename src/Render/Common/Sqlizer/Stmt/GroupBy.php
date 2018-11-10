<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByExpression;
use Subapp\Sql\Render\Common\Sqlizer\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class GroupBy extends Arguments
{
    
    /**
     * @param ExpressionInterface|GroupByExpression $expression
     * @param RendererInterface                     $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->count() > 0 ? sprintf(' GROUP BY %s', parent::getSql($expression, $renderer)) : null;
    }
    
}