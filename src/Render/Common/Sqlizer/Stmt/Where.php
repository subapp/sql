<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Render\Common\Sqlizer\Condition\Conditions;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Where
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class Where extends Conditions
{
    
    /**
     * @param ExpressionInterface|WhereExpression $expression
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $expression, RendererInterface $renderer)
    {
        $collection = $expression->getCollection();
        $exists = $collection && $collection->exists();
        
        return $exists ? sprintf(' WHERE %s', parent::getSql($collection, $renderer)) : null;
    }
    
}