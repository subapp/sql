<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class LogicOperator extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|LogicOperatorExpression $node
     * @param RendererInterface                           $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}