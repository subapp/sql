<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Arguments extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|ArgumentsExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $expressions = [];
    
        foreach ($expression as $argument) {
            $expressions[] = $renderer->render($argument);
        }
        
        return implode(', ', $expressions);
    }
    
}