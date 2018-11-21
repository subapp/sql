<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Common\Collection;
use Subapp\Sql\Ast\NodeInterface;

/**
 * Class Renderer
 * @package Subapp\Sql\Render
 */
class Renderer implements RendererInterface
{
    
    /**
     * @var Collection|RepresentInterface[]
     */
    private $collection;
    
    /**
     * Renderer constructor.
     */
    public function __construct()
    {
        $this->collection = new Collection();
        $this->collection->setClass(RepresentInterface::class);
    }
    
    /**
     * @inheritdoc
     */
    public function setup(RendererSetupInterface $rendererSetup)
    {
        $rendererSetup->setup($this);
    }
    
    /**
     * @inheritdoc
     */
    public function addRepresent(RepresentInterface $represent)
    {
        $this->collection->offsetSet($represent->getName(), $represent);
    }
    
    /**
     * @inheritdoc
     */
    public function removeRepresent($name)
    {
        $this->collection->offsetUnset($name);
    }
    
    /**
     * @inheritdoc
     */
    public function hasRepresent($name)
    {
        return $this->collection->offsetExists($name);
    }
    
    /**
     * @inheritdoc
     */
    public function getRepresent($name)
    {
        $represent = $this->collection->offsetGet($name);
    
        if (!($represent instanceof RepresentInterface)) {
            throw new \RuntimeException(sprintf('Render cannot be performed because such represent handler "%s" doesn\'t exist',
                $name));
        }
        
        return $represent;
    }
    
    /**
     * @inheritdoc
     */
    public function render(NodeInterface $expression)
    {
        return $this->getRepresent($expression->getRenderer())->getSql($expression, $this);
    }

    /**
     * @inheritdoc
     */
    public function toArray(NodeInterface $expression)
    {
        return $this->getRepresent($expression->getRenderer())->toArray($expression, $this);
    }

    /**
     * @inheritdoc
     */
    public function fromArray(NodeInterface $node, array $values)
    {
        return null;
    }
    
}