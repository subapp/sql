<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\RepresenterInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Converter\Common
 */
class MathOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|MathOperatorExpression $node
     * @param RepresenterInterface                          $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, RepresenterInterface $renderer)
    {
        return $node->getOperator();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|MathOperatorExpression $node
     */
    public function toArray(NodeInterface $node, RepresenterInterface $renderer)
    {
        return ['operator' => $node->getOperator(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, RepresenterInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}