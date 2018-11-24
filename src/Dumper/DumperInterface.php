<?php

namespace Subapp\Sql\Dumper;

/**
 * Interface ParserInterface
 * @package Subapp\Sql\Dumper
 */
interface DumperInterface
{
    
    /**
     * @param $contentString
     * @return mixed
     */
    public function parse($contentString);
    
    /**
     * @param array $parameters
     * @return mixed
     */
    public function dump(array $parameters);
    
}