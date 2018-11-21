<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\Common\Converter\Arguments;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class OrderByItems
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
 */
class OrderByItems extends Arguments
{
    
    /**
     * @param NodeInterface|ArgumentsExpression $node
     * @param RepresenterInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' ORDER BY %s', parent::toSql($node, $renderer)) : null;
    }
    
}