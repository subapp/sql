<?php

namespace Subapp\Sql\Converter\Common\Stmt;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\OrderBy as OrderByNode;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Converter\Common\Stmt
 */
class OrderBy extends AbstractConverter
{
    
    /**
     * @param NodeInterface|OrderByNode $node
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
     * @param NodeInterface|OrderByNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['expression'] = $provider->toArray($node->getExpression());
        $values['vector'] = $node->getDirection();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $order = new OrderByNode();

        $order->setExpression($provider->toNode($ast['expression']));
        $order->setDirection($ast['vector']);

        return $order;
    }

}