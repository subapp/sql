<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\In as InNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class In
 * @package Subapp\Sql\Converter\Common\Condition
 */
class In extends AbstractConverter
{
    
    /**
     * @param NodeInterface|InNode $node
     * @param ProviderInterface    $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s%sIN(%s)',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '),
            $provider->toSql($node->getRight()));
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|InNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['left'] = $provider->toArray($node->getLeft());
        $values['isNot'] = $node->isNot();
        $values['args'] = $provider->toArray($node->getRight());
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $in = new InNode();
        
        $in->setLeft($provider->toNode($ast['left']));
        $in->setIsNot($ast['isNot']);
        $in->setRight($provider->toNode($ast['args']));
        
        return $in;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_CONDITION_IN;
    }
    
}