<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Converter\Common\Condition
 */
class LogicOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LogicOperatorExpression $node
     * @param ProviderInterface                           $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}