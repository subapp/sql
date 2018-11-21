<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Representer\Common\Converter\Condition\Conditions;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Where
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
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