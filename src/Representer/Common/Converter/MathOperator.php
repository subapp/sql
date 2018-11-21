<?php

namespace Subapp\Sql\Representer\Common\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Representer\AbstractConverter;
use Subapp\Sql\Representer\RepresenterInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Representer\Common\Converter
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