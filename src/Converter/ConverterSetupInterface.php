<?php

namespace Subapp\Sql\Converter;

/**
 * Interface ConverterSetupInterface
 * @package Subapp\Sql\Converter
 */
interface ConverterSetupInterface
{
    
    /**
     * @param ProviderInterface $renderer
     */
    public function setup(ProviderInterface $renderer);
    
}