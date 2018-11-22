<?php

namespace Subapp\Sql\Converter;

use Subapp\Sql\Common\Collection;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class Converter
 * @package Subapp\Sql\Converter
 */
class Representer implements RepresenterInterface
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
    public function setup(RepresenterSetupInterface $rendererSetup)
    {
        $rendererSetup->setup($this);
    }
    
    /**
     * @inheritdoc
     */
    public function append(ConverterInterface $represent)
    {
        $this->collection->offsetSet($represent->getName(), $represent);
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
        $represent = $this->collection->offsetGet($name);
    
        if (!($represent instanceof ConverterInterface)) {
            throw new \RuntimeException(sprintf('Converter cannot be performed because such represent handler "%s" doesn\'t exist',
                $name));
        }
        
        return $represent;
    }
    
    /**
     * @inheritdoc
     */
    public function toSql(NodeInterface $expression)
    {
        return $this->getConverter($expression->getRenderer())
            ->toSql($expression, $this);
    }

    /**
     * @inheritdoc
     */
    public function toArray(NodeInterface $expression)
    {
        return $this->getConverter($expression->getRenderer())
            ->toArray($expression, $this);
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