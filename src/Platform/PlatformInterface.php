<?php

namespace Subapp\Sql\Platform;

/**
 * Class AbstractPlatform
 * @package Subapp\Sql\Platform
 */
interface PlatformInterface
{
    
    /**
     * @return string
     */
    public function getName();
    
}