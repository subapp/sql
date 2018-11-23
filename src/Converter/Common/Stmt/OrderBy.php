<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByStmt;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class OrderBy extends AbstractConverter
{
    
    /**
     * @param NodeInterface|OrderByStmt $node
     * @param ProviderInterface               $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s %s', $provider->toSql($node->getExpression()), $node->getDirection());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|OrderByStmt $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
       return [
           'order' => $provider->toArray($node->getExpression()),
           'direction' => $node->getDirection(),
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