<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\Collection;
use Subapp\Sql\Context;
use Subapp\Sql\Exception\InvalidValueException;

/**
 * Class Converter
 * @package Subapp\Sql\Converter
 */
final class Converter implements ProviderInterface
{
    
    /**
     * @var Collection|ConverterInterface[]
     */
    private $collection;
    
    /**
     * @var Context
     */
    private $context;
    
    /**
     * Renderer constructor.
     */
    public function __construct()
    {
        $this->collection = new Collection();
        $this->context = new Context();
        $this->collection->setClass(ConverterInterface::class);
    }
    
    /**
     * @inheritdoc
     */
    public function setup(ConverterSetupInterface $setup)
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
     *
     * @throws InvalidValueException
     */
    public function getConverter($name)
    {
        $converter = $this->collection->offsetGet($name);
        
        if (!($converter instanceof ConverterInterface)) {
            throw new InvalidValueException(sprintf('Converter cannot be performed because such converter handler "%s" doesn\'t exist',
                $name));
        }
        
        return $converter;
    }
    
    /**
     * @inheritdoc
     */
    public function toSql(NodeInterface $node)
    {
        return $this->getConverter($node->getConverter())
            ->toSql($node, $this);
    }
    
    /**
     * @inheritdoc
     */
    public function toArray(NodeInterface $node)
    {
        return $this->getConverter($node->getConverter())
            ->toArray($node, $this);
    }
    
    /**
     * @inheritdoc
     */
    public function toNode(array $ast)
    {
        return $this->getConverter($ast['node'] ?? ConverterInterface::CONVERTER_RAW)
            ->toNode($ast, $this);
    }
    
    /**
     * @inheritdoc
     */
    public function getContext()
    {
        return $this->context;
    }
    
}