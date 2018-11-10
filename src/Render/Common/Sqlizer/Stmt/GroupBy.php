<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class GroupBy extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
    
    }
    
}