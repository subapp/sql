<?php

namespace Subapp\Sql\Common;

/**
 * Trait ClassNameTrait
 * @package Subapp\Sql\Common
 */
trait ClassNameTrait
{

    /**
     * @param string $className
     * @param null|string $prefix
     * @return string
     */
    public function getObjectName($className, $prefix = null)
    {
        $namespace = explode('\\', $className);

        return sprintf('%s::%s', $prefix, array_pop($namespace));
    }

}