<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\IsNull as IsNullExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class IsNull
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class IsNull extends AbstractSqlizer
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