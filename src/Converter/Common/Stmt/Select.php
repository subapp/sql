<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class Select
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Select extends AbstractConverter
{

    /**
     * @param RepresenterInterface $renderer
     * @param NodeInterface|SelectExpression $node
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf("SELECT %s%s%s%s%s%s%s%s",
            $renderer->toSql($node->getArguments()),
            $renderer->toSql($node->getFrom()),
            $renderer->toSql($node->getJoins()),
            $renderer->toSql($node->getWhere()),
            $renderer->toSql($node->getGroupBy()),
            $renderer->toSql($node->getHaving()),
            $renderer->toSql($node->getOrderBy()),
            $renderer->toSql($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|SelectExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
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
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}