<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Representer\Common\Converter\Condition
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