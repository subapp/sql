<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Converter\Common\Condition\Conditions;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Where
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Where extends Conditions
{
    
    /**
     * @param NodeInterface|WhereExpression $node
     * @param RepresenterInterface                   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return $node->isNotEmpty() ? sprintf(' WHERE %s', parent::toSql($node, $renderer)) : null;
    }
    
}