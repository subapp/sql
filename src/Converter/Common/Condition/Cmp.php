<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Cmp as PrecedenceNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Cmp
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Cmp extends AbstractConverter
{
    
    /**
     * @param NodeInterface|PrecedenceNode $node
     * @param ProviderInterface                        $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s %s %s',
            $provider->toSql($node->getLeft()),
            $provider->toSql($node->getOperator()),
            $provider->toSql($node->getRight()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|PrecedenceNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['left'] = $provider->toArray($node->getLeft());
        $values['operator'] = $provider->toArray($node->getOperator());
        $values['right'] = $provider->toArray($node->getRight());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $predicate = new PrecedenceNode();

        $predicate->setLeft($provider->toNode($ast['left']));
        $predicate->setOperator($provider->toNode($ast['operator']));
        $predicate->setRight($provider->toNode($ast['right']));

        return $predicate;
    }

}