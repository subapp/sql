<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Select
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Select extends AbstractRepresent
{

    /**
     * @param RendererInterface $renderer
     * @param NodeInterface|SelectExpression $node
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf("SELECT %s%s%s%s%s%s%s%s",
            $renderer->render($node->getArguments()),
            $renderer->render($node->getFrom()),
            $renderer->render($node->getJoins()),
            $renderer->render($node->getWhere()),
            $renderer->render($node->getGroupBy()),
            $renderer->render($node->getHaving()),
            $renderer->render($node->getOrderBy()),
            $renderer->render($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|SelectExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return [
            'arguments' => $renderer->toArray($node->getArguments()),
            'from' => $renderer->toArray($node->getFrom()),
            'joins' => $renderer->toArray($node->getJoins()),
            'where' => $renderer->toArray($node->getWhere()),
            'groupBy' => $renderer->toArray($node->getGroupBy()),
            'having' => $renderer->toArray($node->getHaving()),
            'orderBy' => $renderer->toArray($node->getOrderBy()),
            'limit' => $renderer->toArray($node->getLimit()),
            'semicolon' => $renderer->toArray(new Literal($node->isSemicolon(), Literal::BOOLEAN)),
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