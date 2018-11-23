<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Select as SelectNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Select
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class Select extends AbstractConverter
{

    /**
     * @param ProviderInterface $provider
     * @param NodeInterface|SelectNode $node
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf("SELECT %s%s%s%s%s%s%s%s",
            $provider->toSql($node->getArguments()),
            $provider->toSql($node->getFrom()),
            $provider->toSql($node->getJoins()),
            $provider->toSql($node->getWhere()),
            $provider->toSql($node->getGroupBy()),
            $provider->toSql($node->getHaving()),
            $provider->toSql($node->getOrderBy()),
            $provider->toSql($node->getLimit()),
            $node->isSemicolon() ? "\n;" : null
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|SelectNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        return [
            'arguments' => $provider->toArray($node->getArguments()),
            'from' => $provider->toArray($node->getFrom()),
            'joins' => $provider->toArray($node->getJoins()),
            'where' => $provider->toArray($node->getWhere()),
            'groupBy' => $provider->toArray($node->getGroupBy()),
            'having' => $provider->toArray($node->getHaving()),
            'orderBy' => $provider->toArray($node->getOrderBy()),
            'limit' => $provider->toArray($node->getLimit()),
            'semicolon' => $provider->toArray(new Literal($node->isSemicolon(), Literal::BOOLEAN)),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        // TODO: Implement fromArray() method.
    }

}