<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderByItems as OrderByItemsNode;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class OrderByItems
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * @param NodeInterface|OrderByItemsNode $node
     * @param ProviderInterface              $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->count() > 0 ? sprintf(' ORDER BY %s', parent::toSql($node, $provider)) : null;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new OrderByItemsNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_ORDER_BY_ITEMS;
    }
    
}