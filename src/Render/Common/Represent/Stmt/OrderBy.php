<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByStmt;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class OrderBy extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|OrderByStmt $node
     * @param RendererInterface               $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s %s', $renderer->render($node->getExpression()), $node->getDirection());
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|OrderByStmt $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
       return [
           'order' => $renderer->toArray($node->getExpression()),
           'direction' => $node->getDirection(),
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