<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Arguments as ArgumentsNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class OrderByItems
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * @param NodeInterface|ArgumentsNode $node
     * @param ProviderInterface                       $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->count() > 0 ? sprintf(' ORDER BY %s', parent::toSql($node, $provider)) : null;
    }
    
}