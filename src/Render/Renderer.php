<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Common\Collection;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Renderer
 * @package Subapp\Sql\Render
 */
class Renderer implements RendererInterface
{
    
    /**
     * @var Collection|RepresentInterface[]
     */
    private $sqlizers;
    
    /**
     * Renderer constructor.
     */
    public function __construct()
    {
        $this->sqlizers = new Collection();
        $this->sqlizers->setClass(RepresentInterface::class);
    }
    
    /**
     * @param RendererSetupInterface $rendererSetup
     */
    public function setup(RendererSetupInterface $rendererSetup)
    {
        $rendererSetup->setup($this);
    }
    
    /**
     * @param RepresentInterface $sqlizer
     */
    public function addRepresent(RepresentInterface $sqlizer)
    {
        $this->sqlizers->offsetSet($sqlizer->getName(), $sqlizer);
    }
    
    /**
     * @param string $name
     */
    public function removeSqlizer($name)
    {
        $this->sqlizers->offsetUnset($name);
    }
    
    /**
     * @param string $name
     * @return boolean
     */
    public function hasSqlizer($name)
    {
        return $this->sqlizers->offsetExists($name);
    }
    
    /**
     * @param string $name
     * @return RepresentInterface
     * @throws \RuntimeException
     */
    public function getSqlizer($name)
    {
        $sqlizer = $this->sqlizers->offsetGet($name);
    
        if (!($sqlizer instanceof RepresentInterface)) {
            throw new \RuntimeException(sprintf('Render cannot be performed because such sqlizer "%s"  doesn\'t exist',
                $name));
        }
        
        return $sqlizer;
    }
    
    /**
     * @param ExpressionInterface $expression
     * @return string
     */
    public function render(ExpressionInterface $expression)
    {
        return $this->getSqlizer($expression->getRenderer())->getSql($expression, $this);
    }
    
}