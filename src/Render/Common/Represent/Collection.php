<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\Collection as CollectionExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Render\Common\Represent
 */
class Collection extends AbstractRepresent
{
    
    /**
     * @param ExpressionInterface|CollectionExpression $collection
     * @param RendererInterface                        $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        $pieces = [];
        $separator = $collection->getSeparator();
        
        foreach ($collection as $expression) {
            $pieces[] = $renderer->render($expression);
        }

        return implode($separator, $pieces);
    }
    
}