<?php

namespace Subapp\Sql\Dumper;


/**
 * Class JsonParser
 * @package Subapp\Sql\Dumper
 */
class JsonDumper implements DumperInterface
{
    
    /**
     * @inheritDoc
     */
    public function parse($contentString)
    {
        return json_decode($contentString, JSON_OBJECT_AS_ARRAY);
    }
    
    /**
     * @inheritDoc
     */
    public function dump(array $parameters)
    {
        return json_encode($parameters, JSON_PRETTY_PRINT);
    }
    
}