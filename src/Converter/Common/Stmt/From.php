<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\From as FromExpression;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class From
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class From extends Arguments
{
    
    /**
     * @param RepresenterInterface   $renderer
     * @param NodeInterface|FromExpression $node
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf(' FROM %s', parent::toSql($node, $renderer));
    }

}