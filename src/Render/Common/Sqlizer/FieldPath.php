<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class FieldPath extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|FieldPathExpression $expression
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s.%s',
            $renderer->render($expression->getTable()), $renderer->render($expression->getField()));
    }
    
}