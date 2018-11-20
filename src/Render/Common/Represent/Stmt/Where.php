<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Render\Common\Represent\Condition\Conditions;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Where
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Where extends Conditions
{
    
    /**
     * @param ExpressionInterface|WhereExpression $expression
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $expression->isNotEmpty() ? sprintf(' WHERE %s', parent::getSql($expression, $renderer)) : null;
    }
    
}