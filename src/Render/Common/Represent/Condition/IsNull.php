<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\IsNull as IsNullExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class IsNull
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class IsNull extends AbstractRepresent
{
    
    /**
     * @param ExpressionInterface|IsNullExpression $expression
     * @param RendererInterface                    $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s IS%sNULL',
            $renderer->render($expression->getLeft()),
            ($expression->isNot() ? ' NOT ' : ' '));
    }
    
}