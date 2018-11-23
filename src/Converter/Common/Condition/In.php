<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\In as InExpression;
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
     * @param NodeInterface|InExpression $node
     * @param ProviderInterface                $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s%sIN(%s)',
            $renderer->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $renderer->toSql($node->getRight()));
    }
    
}