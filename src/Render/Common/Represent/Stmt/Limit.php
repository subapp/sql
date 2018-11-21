<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\Stmt\Limit as LimitExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Limit extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|LimitExpression $node
     * @param RendererInterface                   $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        $offset = $node->getOffset();
        $length = $node->getLength();
        
        switch (true) {
            case ($length instanceOf Literal && !($offset instanceOf Literal)):
                return sprintf(' LIMIT %s', $renderer->render($length));
            case ($length instanceOf Literal && $offset instanceOf Literal):
                return sprintf(' LIMIT %s, %s', $renderer->render($offset), $renderer->render($length));
        }
    
        return null;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|LimitExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return [
            'offset' => $node->getOffset(),
            'length' => $node->getLength(),
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