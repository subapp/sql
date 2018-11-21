<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\JoinItems as JoinItemsExpression;
use Subapp\Sql\Representer\Common\Converter\Collection;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class JoinItems
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * @param NodeInterface|JoinItemsExpression $collection
     * @param RepresenterInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, RepresenterInterface $renderer)
    {
        return $collection->count() > 0 ? sprintf(' %s', parent::toSql($collection, $renderer)) : null;
    }
    
}