<?php

namespace Subapp\Sql\Render\Common\Sqlizer\Stmt;

use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\JoinItems as JoinItemsExpression;
use Subapp\Sql\Render\Common\Sqlizer\Collection;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class JoinItems
 * @package Subapp\Sql\Render\Common\Sqlizer\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * @param ExpressionInterface|JoinItemsExpression $collection
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(ExpressionInterface $collection, RendererInterface $renderer)
    {
        return $collection->count() > 0 ? sprintf(' %s', parent::getSql($collection, $renderer)) : null;
    }
    
}