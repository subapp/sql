<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Between
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Between extends AbstractConverter
{
    
    /**
     * @param NodeInterface|BetweenNode $node
     * @param ProviderInterface                     $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $provider->toSql($node->getA()),
            $provider->toSql($node->getB()));
    }
    
}