<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Parameter as ParameterExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Parameter extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|ParameterExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $parameter = sprintf('%s', $expression->getType());
        
        if ($expression->isNamed()) {
            $parameter = sprintf('%s%s', $parameter, $expression->getName());
        }
        
        return $parameter;
    }
    
}