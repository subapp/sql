<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Between
 * @package Subapp\Sql\Representer\Common\Converter\Condition
 */
class Between extends AbstractConverter
{
    
    /**
     * @param NodeInterface|BetweenExpression $node
     * @param RepresenterInterface                     $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->toSql($node->getA()),
            $renderer->toSql($node->getB()));
    }
    
}