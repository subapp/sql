<?php

namespace Subapp\Sql\Render\Common\Sqlizer;

use Subapp\Sql\Ast\Collection as CollectionExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractSqlizer;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Render\Common\Sqlizer
 */
class Collection extends AbstractSqlizer
{
    
    /**
     * @param ExpressionInterface|CollectionExpression $collection
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        $pieces = [];
        
        foreach ($collection as $expression) {
            $pieces[] = $renderer->render($expression);
        }
        
        return implode(' ', $pieces);
    }
    
}