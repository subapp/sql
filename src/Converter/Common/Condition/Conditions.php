<?php

namespace Subapp\Sql\Converter\Common\Condition;

use Subapp\Sql\Ast\Condition\Conditions as ConditionsNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\Common\Collection;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Conditions
 * @package Subapp\Sql\Converter\Common\Condition
 */
class Conditions extends Collection
{
    
    /**
     * @param NodeInterface|ConditionsNode $collection
     * @param ProviderInterface            $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        $operator = $provider->toSql($collection->getOperator());
        
        $collection->setSeparator(sprintf("\x20%s\x20", $operator));
        
        return sprintf($collection->isBraced() ? '(%s)' : '%s', parent::toSql($collection, $provider));
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|ConditionsNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $values['operator'] = $provider->toArray($node->getOperator());
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        /** @var ConditionsNode $node */
        $node = $this->toCollection(new ConditionsNode(), $ast, $provider);
        
        $node->setOperator($provider->toNode($ast['operator']));
        
        return $node;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_CONDITION_CONDITIONS;
    }
    
}