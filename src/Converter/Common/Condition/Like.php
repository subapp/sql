<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeExpression;
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
     * @param NodeInterface|LikeExpression $node
     * @param ProviderInterface                  $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s%s LIKE %s',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT' : null),
            $renderer->toSql($node->getRight()));
    }
    
}