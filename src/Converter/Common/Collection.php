<?php

namespace Subapp\Sql\Converter\Common;

use Subapp\Sql\Ast\Collection as CollectionNode;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Converter\AbstractConverter;
use Subapp\Sql\Converter\ProviderInterface;

/**
 * Class Collection
 * @package Subapp\Sql\Converter\Common
 */
class Collection extends AbstractConverter
{
    
    /**
     * @param NodeInterface|CollectionNode $collection
     * @param ProviderInterface            $provider
     * @return string
     */
    public function toSql(NodeInterface $collection, ProviderInterface $provider)
    {
        $nodes = $collection->map(function (NodeInterface $inner) use ($provider) {
            return $provider->toSql($inner);
        });
        
        return implode($collection->getSeparator(), $nodes->toArray());
    }
    
    /**
     * @inheritDoc
     *
     * @param NodeInterface|CollectionNode $node
     */
    public function toArray(NodeInterface $node, ProviderInterface $provider)
    {
        $values = parent::toArray($node, $provider);
        
        $class = $node->getClass();
        $nodes = $node->map(function (NodeInterface $inner) use ($provider) {
            return $provider->toArray($inner);
        })->toArray();
        
        $values['class'] = $class;
        $values['isBraced'] = $node->isBraced();
        $values['nodes'] = $nodes;
        
        return $values;
    }
    
    /**
     * @inheritDoc
     */
    public function toNode(array $ast, ProviderInterface $provider)
    {
        return $this->toCollection(new CollectionNode(), $ast, $provider);
    }
    
    /**
     * @param CollectionNode    $collection
     * @param array             $ast
     * @param ProviderInterface $provider
     * @return CollectionNode
     */
    protected function toCollection(CollectionNode $collection, array $ast, ProviderInterface $provider)
    {
        /** @var CollectionNode $collection */
        $collection->asBatch($ast['nodes']);
        
        $collection = $collection->map(function ($node) use ($provider) {
            return $provider->toNode($node);
        });
        
        $collection->setClass($ast['class']);
        $collection->setIsBraced($ast['isBraced']);
        
        return $collection;
    }
    
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::CONVERTER_COLLECTION;
    }
    
}