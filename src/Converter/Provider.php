<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Common\Collection;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class Converter
 * @package Subapp\Sql\Converter
 */
class Provider implements ProviderInterface
{
    
    /**
     * @var Collection|ConverterInterface[]
     */
    private $collection;
    
    /**
     * Renderer constructor.
     */
    public function __construct()
    {
        $this->collection = new Collection();
        $this->collection->setClass(ConverterInterface::class);
    }
    
    /**
     * @inheritdoc
     */
    public function setup(ProviderSetupInterface $setup)
    {
        $setup->setup($this);
    }
    
    /**
     * @inheritdoc
     */
    public function append(ConverterInterface $converter)
    {
        $this->collection->offsetSet($converter->getName(), $converter);
    }
    
    /**
     * @inheritdoc
     */
    public function remove($name)
    {
        $this->collection->offsetUnset($name);
    }
    
    /**
     * @inheritdoc
     */
    public function has($name)
    {
        return $this->collection->offsetExists($name);
    }
    
    /**
     * @inheritdoc
     */
    public function getConverter($name)
    {
        $converter = $this->collection->offsetGet($name);
    
        if (!($converter instanceof ConverterInterface)) {
            throw new \RuntimeException(sprintf('Converter cannot be performed because such converter handler "%s" doesn\'t exist',
                $name));
        }
        
        return $converter;
    }
    
    /**
     * @inheritdoc
     */
    public function toSql(NodeInterface $node)
    {
        return $this->getConverter($node->getRenderer())
            ->toSql($node, $this);
    }

    /**
     * @inheritdoc
     */
    public function toArray(NodeInterface $node)
    {
        return $this->getConverter($node->getRenderer())
            ->toArray($node, $this);
    }

    /**
     * @inheritdoc
     */
    public function toNode(array $ast)
    {
        return $this->getConverter($ast['converter'])
            ->toNode($ast, $this);
    }
    
}