<?php

namespace Subapp\Sql\Render\Common\Represent\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Render\Common\Represent\Condition
 */
class CmpOperator extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|CmpOperatorExpression $node
     * @param RendererInterface                         $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return (string)$node->getOperator();
    }
    
}