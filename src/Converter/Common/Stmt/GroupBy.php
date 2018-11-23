<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByExpression;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class GroupBy extends Arguments
{
    
    /**
     * @param NodeInterface|GroupByExpression $node
     * @param ProviderInterface                     $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' GROUP BY %s', parent::toSql($node, $renderer)) : null;
    }

}