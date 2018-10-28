<?php

namespace Subapp\Sql\Platform;

/**
 * Class AbstractPlatform
 * @package Subapp\Sql\Platform
 */
abstract class AbstractPlatform implements PlatformInterface
{
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * Platform constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
}