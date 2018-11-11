<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\From as FromExpression;
use Subapp\Sql\Render\Common\Sqlizer\Arguments;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class From
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class From extends Arguments
{
    
    /**
     * @param RendererInterface   $renderer
     * @param ExpressionInterface|FromExpression $expression
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf(' FROM %s', parent::getSql($expression, $renderer));
    }
    
}