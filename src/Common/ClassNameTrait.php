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
        
//        $flags = (PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
//
//        $class = preg_split('/([A-Z]?[^A-Z]+)/', array_pop($namespace), -1, $flags);
//        $class = implode('_', $class);

        return sprintf('%s::%s', $prefix, array_pop($namespace));
    }

}