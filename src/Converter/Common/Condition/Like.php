<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Like
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Like extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LikeNode $node
     * @param ProviderInterface                  $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%s LIKE %s',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT' : null),
            $provider->toSql($node->getRight()));
    }
    
}