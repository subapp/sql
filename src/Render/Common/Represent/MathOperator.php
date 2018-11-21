<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Render\Common\Represent
 */
class MathOperator extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|MathOperatorExpression $node
     * @param RendererInterface                          $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return $node->getOperator();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|MathOperatorExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['operator' => $node->getOperator(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}