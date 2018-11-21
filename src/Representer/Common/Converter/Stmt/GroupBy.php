<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\GroupBy as GroupByExpression;
use Subapp\Sql\Representer\Common\Converter\Arguments;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class GroupBy
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
 */
class GroupBy extends Arguments
{
    
    /**
     * @param NodeInterface|GroupByExpression $node
     * @param RepresenterInterface                     $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' GROUP BY %s', parent::toSql($node, $renderer)) : null;
    }

}