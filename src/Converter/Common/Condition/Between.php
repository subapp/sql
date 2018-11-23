<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenExpression;
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
     * @param NodeInterface|BetweenExpression $node
     * @param ProviderInterface                     $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->toSql($node->getA()),
            $renderer->toSql($node->getB()));
    }
    
}