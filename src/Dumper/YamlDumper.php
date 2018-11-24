<?php

namespace Subapp\Sql\Dumper;

use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlParser
 * @package Subapp\Sql\Dumper
 */
class YamlDumper implements DumperInterface
{
    
    /**
     * @inheritDoc
     */
    public function parse($contentString)
    {
        return Yaml::parse($contentString);
    }
    
    /**
     * @inheritDoc
     */
    public function dump(array $parameters)
    {
        return Yaml::dump($parameters, 16);
    }
    
}