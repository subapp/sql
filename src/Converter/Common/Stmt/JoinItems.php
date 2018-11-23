<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\JoinItems as JoinItemsNode;
use Subapp\Sql\Converter\Common\Collection;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class JoinItems
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class JoinItems extends Collection
{
    
    /**
     * @param NodeInterface|JoinItemsNode $collection
     * @param ProviderInterface                       $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        return $collection->count() > 0 ? sprintf(' %s', parent::toSql($collection, $provider)) : null;
    }
    
}