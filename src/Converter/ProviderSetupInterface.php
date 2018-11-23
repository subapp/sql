<?php

namespace Subapp\Sql\Converter;

/**
 * Interface ProviderSetupInterface
 * @package Subapp\Sql\Converter
 */
interface ProviderSetupInterface
{
    
    /**
     * @param ProviderInterface $renderer
     */
    public function setup(ProviderInterface $renderer);
    
}