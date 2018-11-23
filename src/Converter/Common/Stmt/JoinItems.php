<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\JoinItems as JoinItemsExpression;
use Subapp\Sql\Converter\Common\Collection;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class JoinItems
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * @param NodeInterface|JoinItemsExpression $collection
     * @param ProviderInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $renderer)
    {
        return $collection->count() > 0 ? sprintf(' %s', parent::toSql($collection, $renderer)) : null;
    }
    
}