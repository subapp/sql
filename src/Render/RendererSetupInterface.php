<?php

namespace Subapp\Sql\Render;

/**
 * Interface RendererSetupLoader
 * @package Subapp\Sql\Render
 */
interface RendererSetupInterface
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer);
    
}