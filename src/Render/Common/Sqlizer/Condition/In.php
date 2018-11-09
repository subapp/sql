<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\In as InExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class In
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class In extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|InExpression $expression
     * @param RendererInterface                $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        return sprintf('%s%sIN(%s)',
            $renderer->render($expression->getLeft()),
            ($expression->isNot() ? ' NOT ' : ' '),
            $renderer->render($expression->getRight()));
    }
    
}