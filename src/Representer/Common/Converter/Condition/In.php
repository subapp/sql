<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\In as InExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class In
 * @package Subapp\Sql\Representer\Common\Converter\Condition
 */
class In extends AbstractConverter
{
    
    /**
     * @param NodeInterface|InExpression $node
     * @param RepresenterInterface                $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s%sIN(%s)',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->toSql($node->getRight()));
    }
    
}