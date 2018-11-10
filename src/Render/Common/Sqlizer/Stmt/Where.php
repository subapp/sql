<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Where
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class Where extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|WhereExpression $expression
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $collection = $expression->getCollection();
        $isNotEmpty = $collection && $collection->isNotEmpty();
        
        return $isNotEmpty ? sprintf(' WHERE %s', $renderer->render($collection)) : null;
    }
    
}