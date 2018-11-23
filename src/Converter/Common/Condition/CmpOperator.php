<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Operator as CmpOperatorNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Converter\Common\Condition
 */
class CmpOperator extends AbstractConverter
{
    
    /**
     * @param NodeInterface|CmpOperatorNode $node
     * @param ProviderInterface                         $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return (string)$node->getOperator();
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|CmpOperatorNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['value'] = $node->getOperator();

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return new CmpOperatorNode($ast['operator']);
    }
    
}