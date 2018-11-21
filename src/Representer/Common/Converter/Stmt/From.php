<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\From as FromExpression;
use Subapp\Sql\Representer\Common\Converter\Arguments;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class From
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
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