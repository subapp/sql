<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\In as InNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class In
 * @package Subapp\Sql\Converter\Common\Condition
 */
class In extends AbstractConverter
{
    
    /**
     * @param NodeInterface|InNode $node
     * @param ProviderInterface                $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%sIN(%s)',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $provider->toSql($node->getRight()));
    }
    
}