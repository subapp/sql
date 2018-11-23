<?php

namespace Subapp\Sql\Converter\Common\Func;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Func\AggregateFunction as AggregateFunctionNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class AggregateFunction
 * @package Subapp\Sql\Converter\Common\Func
 */
class AggregateFunction extends AbstractConverter
{

    /**
     * @param NodeInterface|AggregateFunctionNode $node
     * @param ProviderInterface $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        $distinct = $node->isDistinct() ? 'DISTINCT ' : null;
        $function = strtoupper($provider->toSql($node->getFunctionName()));

        return sprintf('%s(%s%s)', $function, $distinct, $provider->toSql($node->getArguments()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|AggregateFunctionNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['name'] = $provider->toArray($node->getFunctionName());
        $values['distinct'] = $node->isDistinct();
        $values['args'] = $provider->toArray($node->getArguments());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $function = new AggregateFunctionNode();

        $function->setFunctionName($this->toNode($ast['name'], $provider));
        $function->setDistinct((boolean)$ast['distinct']);
        $function->setArguments($this->toNode($ast['args'], $provider));

        return $function;
    }

}