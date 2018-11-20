<?php

namespace Subapp\Sql\Render;

use Subapp\Sql\Ast\ExpressionInterface;

/**
 * Interface RendererInterface
 * @package Subapp\Sql\Render
 */
interface RendererInterface
{
    
    /**
     * @param RendererSetupInterface $rendererSetup
     */
    public function setup(RendererSetupInterface $rendererSetup);
    
    /**
     * @param ExpressionInterface $expression
     * @return string
     */
    public function render(ExpressionInterface $expression);
    
    /**
     * @param RepresentInterface $sqlizer
     */
    public function addRepresent(RepresentInterface $sqlizer);
    
    /**
     * @param string $name
     */
    public function removeSqlizer($name);
    
    /**
     * @param string $name
     * @return boolean
     */
    public function hasSqlizer($name);
    
    /**
     * @param string $name
     * @return RepresentInterface
     */
    public function getSqlizer($name);

}