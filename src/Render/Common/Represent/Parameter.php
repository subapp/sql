<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Parameter as ParameterExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Render\Common\Represent
 */
class Parameter extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|ParameterExpression $node
     * @param RendererInterface                       $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        $parameter = sprintf('%s', $node->getType());
        
        if ($node->isNamed()) {
            $parameter = sprintf('%s%s', $parameter, $node->getName());
        }
        
        return $parameter;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|ParameterExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return ['name' => $node->getName(), 'type' => $node->getType(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}