<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Arguments as ArgumentsExpression;
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
     * @param NodeInterface|ArgumentsExpression $node
     * @param ProviderInterface                       $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return $node->count() > 0 ? sprintf(' ORDER BY %s', parent::toSql($node, $renderer)) : null;
    }
    
}