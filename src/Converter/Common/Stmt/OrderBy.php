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
     * @param ProviderInterface               $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return sprintf('%s %s', $renderer->toSql($node->getExpression()), $node->getDirection());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|OrderByStmt $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
       return [
           'order' => $renderer->toArray($node->getExpression()),
           'direction' => $node->getDirection(),
       ];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}