<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Cmp extends AbstractConverter
{
    
    /**
     * @param NodeInterface|PrecedenceNode $node
     * @param ProviderInterface                        $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s %s %s',
            $provider->toSql($node->getLeft()),
            $provider->toSql($node->getOperator()),
            $provider->toSql($node->getRight()));
    }
    
}