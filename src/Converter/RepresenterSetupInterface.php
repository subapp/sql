<?php

namespace Subapp\Sql\Converter;

/**
 * Interface RepresenterSetupInterface
 * @package Subapp\Sql\Converter
 */
interface RepresenterSetupInterface
{
    
    /**
     * @param RepresenterInterface $renderer
     */
    public function setup(RepresenterInterface $renderer);
    
}