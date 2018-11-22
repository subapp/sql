<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Converter\Common\Condition
 */
class CmpOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|CmpOperatorExpression $node
     * @param RepresenterInterface                         $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}