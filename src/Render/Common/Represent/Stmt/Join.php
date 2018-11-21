<?php

namespace Subapp\Sql\Render\Common\Represent\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Join as JoinExpression;
use Subapp\Sql\Render\AbstractRepresent;
use Subapp\Sql\Render\RendererInterface;

/**
 * Class Join
 * @package Subapp\Sql\Render\Common\Represent\Stmt
 */
class Join extends AbstractRepresent
{
    
    /**
     * @param NodeInterface|JoinExpression $node
     * @param RendererInterface                  $renderer
     * @return string
     */
    public function getSql(NodeInterface $node, RendererInterface $renderer)
    {
        return sprintf('%s JOIN %s %s (%s)',
            $node->getJoinType(),
            $renderer->render($node->getLeft()),
            $node->getConditionType(),
            $renderer->render($node->getCondition())
        );
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|JoinExpression $node
     */
    public function toArray(NodeInterface $node, RendererInterface $renderer)
    {
        return [
            'type' => $node->getJoinType(),
            'conditionType' => $node->getConditionType(),
            'left' => $renderer->toArray($node->getLeft()),
            'condition' => $renderer->toArray($node->getCondition()),
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