<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByNode;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class GroupBy extends Arguments
{
    
    /**
     * @param NodeInterface|GroupByNode $node
     * @param ProviderInterface         $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return $node->count() > 0 ? sprintf(' GROUP BY %s', parent::toSql($node, $provider)) : null;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new GroupByNode(), $ast, $provider);
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_STMT_GROUP_BY;
    }
    
}