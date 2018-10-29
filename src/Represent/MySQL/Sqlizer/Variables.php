<?php

namespace Subapp\Sql\Represent\MySQL\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Variables as VariablesExpression;
use Subapp\Sql\Represent\AbstractSqlizer;
use Subapp\Sql\Represent\RendererInterface;

/**
 * Class Variables
 * @package Subapp\Sql\Represent\MySQL\Sqlizer
 */
class Variables extends AbstractSqlizer
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