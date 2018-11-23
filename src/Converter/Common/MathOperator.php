<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\MathOperator as MathOperatorExpression;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class MathOperator
 * @package Subapp\Sql\Converter\Common
 */
class MathOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|MathOperatorExpression $node
     * @param ProviderInterface                          $renderer
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $renderer)
    {
        return $node->getOperator();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|MathOperatorExpression $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $renderer)
    {
        return ['operator' => $node->getOperator(),];
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $renderer)
    {
        // TODO: Implement fromArray() method.
    }

}