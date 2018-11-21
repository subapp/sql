<?php

namespace Subapp\Sql\Representer\Common\Converter\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Representer\Common\Converter\Condition
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