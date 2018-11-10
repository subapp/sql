<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Condition;

use Subapp\Sql\Ast\Condition\Term as TermExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Term
 * @package Subapp\Sql\Render\Common\Sqlizer\Condition
 */
class Term extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|TermExpression $expression
     * @param RendererInterface                  $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $operator = $expression->getOperator() ?
            sprintf(' %s', $renderer->render($expression->getOperator())) : null;
        
        return sprintf('%s%s',
            $renderer->render($expression->getExpression()), $operator);
    }
    
}