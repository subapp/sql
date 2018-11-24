<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\IsNull as IsNullNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class IsNull
 * @package Subapp\Sql\Converter\Common\Condition
 */
class IsNull extends AbstractConverter
{
    
    /**
     * @param NodeInterface|IsNullNode $node
     * @param ProviderInterface        $provider
     * @return string
     */
    public function toSql(NodeInterface $node, ProviderInterface $provider)
    {
        return sprintf('%s IS%sNULL',
            $provider->toSql($node->getLeft()),
            ($node->isNot() ? ' NOT ' : ' '));
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|IsNullNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['left'] = $provider->toArray($node->getLeft());
        $values['isNot'] = $node->isNot();
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        $isNull = new IsNullNode();
        
        $isNull->setLeft($provider->toNode($ast['left']));
        $isNull->setIsNot($ast['isNot']);
        
        return $isNull;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_CONDITION_IS_NULL;
    }
    
}