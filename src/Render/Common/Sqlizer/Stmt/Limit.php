<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\Stmt\Limit as LimitExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class Limit extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|LimitExpression $expression
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $offset = $expression->getOffset();
        $length = $expression->getLength();
        
        switch (true) {
            case ($length instanceOf Literal && !($offset instanceOf Literal)):
                return sprintf(' LIMIT %s', $renderer->render($length));
            case ($length instanceOf Literal && $offset instanceOf Literal):
                return sprintf(' LIMIT %s, %s', $renderer->render($offset), $renderer->render($length));
        }
    
        return null;
    }
    
}