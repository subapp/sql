<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Between as BetweenNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Between
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Between extends AbstractConverter
{
    
    /**
     * @param NodeInterface|BetweenNode $node
     * @param ProviderInterface                     $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%sBETWEEN %s AND %s',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $provider->toSql($node->getA()),
            $provider->toSql($node->getB()));
    }

    /**
     * @inheritDoc
     *
     * @param NodeInterface|BetweenNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);

        $values['left'] = $provider->toArray($node->getLeft());
        $values['a'] = $provider->toArray($node->getA());
        $values['isNot'] = $node->isNot();
        $values['b'] = $provider->toArray($node->getB());

        return $values;
    }

    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $between = new BetweenNode();

        $between->setLeft($provider->toNode($ast['left']));
        $between->setA($provider->toNode($ast['a']));
        $between->setIsNot($ast['isNot']);
        $between->setB($provider->toNode($ast['b']));

        return $between;
    }


}