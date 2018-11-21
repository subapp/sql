<?php

namespace Subapp\Sql\Render\Common\Represent;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Variable as VariableExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Variable
 * @package Subapp\Sql\Render\Common\Represent
 */
class Variable extends AbstractRepresent
{

    /**
     * @param NodeInterface|VariableExpression $node
     * @param RendererInterface $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s%s',
            $renderer->render($node->getExpression()),
            ($node->getAlias() ? sprintf(' AS %s', $renderer->render($node->getAlias())) : null)
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|VariableExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return [
            'expression' => $renderer->toArray($node->getExpression()),
            'alias' => ($node->getAlias() ? $renderer->toArray($node->getAlias()) : null)
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $values, RendererInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }


}