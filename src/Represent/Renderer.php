<?php

namespace Subapp\Sql\Represent;

use Subapp\Collection\Collection;
use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Class Renderer
 * @package Subapp\Sql\Represent
 */
class Renderer implements RendererInterface
{
    
    /**
     * @var Collection|SqlizerInterface[]
     */
    private $sqlizers;
    
    /**
     * Renderer constructor.
     */
    public function __construct()
    {
        $this->sqlizers = new Collection([], SqlizerInterface::class);
    }
    
    /**
     * @param RendererSetupLoaderInterface $loader
     */
    public function setup(RendererSetupLoaderInterface $loader)
    {
        $loader->setup($this);
    }
    
    /**
     * @param SqlizerInterface $sqlizer
     */
    public function addSqlizer(SqlizerInterface $sqlizer)
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
     * @return SqlizerInterface
     * @throws \RuntimeException
     */
    public function getSqlizer($name)
    {
        $sqlizer = $this->sqlizers->offsetGet($name);
    
        if (!($sqlizer instanceof SqlizerInterface)) {
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
        return $this->getSqlizer($expression->getSqlizerName())->getSql($this, $expression);
    }
    
}