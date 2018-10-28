<?php

namespace Subapp\Sql\Represent;

/**
 * Interface RendererSetupLoader
 * @package Subapp\Sql\Represent
 */
interface RendererSetupLoaderInterface
{
    
    /**
     * @param RendererInterface $renderer
     */
    public function setup(RendererInterface $renderer);
    
}