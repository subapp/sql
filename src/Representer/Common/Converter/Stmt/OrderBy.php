<?php

namespace Subapp\Sql\Representer\Common\Converter\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByStmt;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Representer\Common\Converter\Stmt
 */
class OrderBy extends AbstractConverter
{
    
    /**
     * @param NodeInterface|OrderByStmt $node
     * @param RepresenterInterface               $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return sprintf('%s %s', $renderer->toSql($node->getExpression()), $node->getDirection());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|OrderByStmt $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
       return [
           'order' => $renderer->toArray($node->getExpression()),
           'direction' => $node->getDirection(),
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