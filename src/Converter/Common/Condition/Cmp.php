<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Cmp extends AbstractConverter
{
    
    /**
     * @param NodeInterface|PrecedenceExpression $node
     * @param RepresenterInterface                        $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s %s %s',
            $renderer->toSql($node->getLeft()),
            $renderer->toSql($node->getOperator()),
            $renderer->toSql($node->getRight()));
    }
    
}