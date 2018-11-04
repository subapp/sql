<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Arguments as VariablesExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Arguments extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|VariablesExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $expressions = [];
    
        foreach ($expression->getExpressions() as $variable) {
            $expressions[] = $renderer->render($variable);
        }
        
        return implode(', ', $expressions);
    }
    
}