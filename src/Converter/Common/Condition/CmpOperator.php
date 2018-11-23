<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Converter\Common\Condition
 */
class CmpOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|CmpOperatorExpression $node
     * @param ProviderInterface                         $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}