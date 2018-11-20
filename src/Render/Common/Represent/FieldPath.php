<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\FieldPath as FieldPathExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class FieldPath
 * @package Subapp\Sql\Render\Common\Represent
 */
class FieldPath extends AbstractRepresent
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