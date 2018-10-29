<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Operand
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class Operand extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface $expression
     * @param RendererInterface   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return $renderer->render($expression);
    }
    
}