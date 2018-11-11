<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Raw as RawExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Raw
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Raw extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|RawExpression $expression
     * @param RendererInterface                 $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return (string)$expression->getExpression();
    }
    
}