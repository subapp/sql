<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\Stmt\Limit as LimitExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Limit
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Limit extends AbstractConverter
{
    
    /**
     * @param NodeInterface|LimitExpression $node
     * @param RepresenterInterface                   $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        $offset = $node->getOffset();
        $length = $node->getLength();
        
        switch (true) {
            case ($length instanceOf Literal && !($offset instanceOf Literal)):
                return sprintf(' LIMIT %s', $renderer->toSql($length));
            case ($length instanceOf Literal && $offset instanceOf Literal):
                return sprintf(' LIMIT %s, %s', $renderer->toSql($offset), $renderer->toSql($length));
        }
    
        return null;
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|LimitExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return [
            'offset' => $node->getOffset(),
            'length' => $node->getLength(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}