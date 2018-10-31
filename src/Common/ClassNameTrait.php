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
     * @return string
     */
    public function getUnderscore($className)
    {
        $namespace = explode('\\', $className);
        
        $flags = (PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        
        $class = preg_split('/([A-Z]?[^A-Z]+)/', array_pop($namespace), -1, $flags);
        $class = implode('_', $class);
        
        $parserName = sprintf('%s.%s', array_pop($namespace), $class);
        
        return strtolower($parserName);
    }

}