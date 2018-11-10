<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class Limit extends AbstractSqlizer
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