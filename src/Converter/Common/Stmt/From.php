<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\From as FromNode;
use Subapp\Sql\Converter\Common\Arguments;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class From
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class From extends Arguments
{
    
    /**
     * @param ProviderInterface   $provider
     * @param NodeInterface|FromNode $node
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf(' FROM %s', parent::toSql($node, $provider));
    }

}