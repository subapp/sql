<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\Like as LikeExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Like
 * @package Subapp\Sql\Representer\Common\Converter\Condition
 */
class Like extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LikeExpression $node
     * @param RepresenterInterface                  $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s%s LIKE %s',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT' : null),
            $renderer->toSql($node->getRight()));
    }
    
}