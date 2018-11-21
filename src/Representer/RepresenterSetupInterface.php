<?php

namespace Subapp\Sql\Representer;

/**
 * Interface RepresenterSetupInterface
 * @package Subapp\Sql\Representer
 */
interface RepresenterSetupInterface
{
    
    /**
     * @param RepresenterInterface $renderer
     */
    public function setup(RepresenterInterface $renderer);
    
}