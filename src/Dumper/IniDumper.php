<?php

namespace Subapp\Sql\Dumper;

/**
 * Class IniParser
 * @package Subapp\Sql\Dumper
 */
class IniDumper implements DumperInterface
{
    
    /**
     * @inheritDoc
     */
    public function parse($contentString)
    {
        $parameters = parse_ini_string($contentString, INI_SCANNER_NORMAL);
        $parametersArray = [];
        
        foreach ($parameters as $path => $parameter) {
            
            $temporaryArray = &$parametersArray;
            
            foreach (explode('.', $path) as $key) {
                $temporaryArray = &$temporaryArray[$key];
            }
            
            $temporaryArray = $parameter;
        }
        
        return $parametersArray;
    }
    
    /**
     * @inheritDoc
     */
    public function dump(array $parameters)
    {
        $lines = [sprintf('# Dumper: %s DateTime: %s', __CLASS__, (new \DateTime())->format(\DateTime::W3C))];
        
        $this->dumpIniContent($parameters, [], $lines);
        
        return implode(PHP_EOL, $lines);
    }
    
    /**
     * @param array $parameters
     * @param array $indexes
     * @param array $lines
     */
    private function dumpIniContent(array $parameters = [], $indexes = [], &$lines = [])
    {
        foreach ($parameters as $index => $value) {
            $indexes[] = $index;
            
            if (is_array($value)) {
                static::dumpIniContent($value, $indexes, $lines);
            } else {
                $lines[] = implode('.', $indexes) . '="' . addcslashes($value, '"') . '"';
            }
            
            array_pop($indexes);
        }
    }
    
}