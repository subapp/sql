<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Representer\Common\Converter\Condition
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