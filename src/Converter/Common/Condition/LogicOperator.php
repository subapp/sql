<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Converter\Common\Condition
 */
class LogicOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LogicOperatorExpression $node
     * @param RepresenterInterface                           $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}