<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Sql\Syntax\MySQL\Parser;
use Subapp\Sql\Syntax\ParserProcessorSetupLoaderInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class MySQLParserProcessorSetupLoader
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class MySQLParserProcessorSetupLoader implements ParserProcessorSetupLoaderInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor)
    {
        // general statement parsers
        $processor->addParser(new Parser\Statement\Select());
        
        // common expression parsers
        $processor->addParser(new Parser\From());
        
        // default MySQL function parsers
        $processor->addParser(new Parser\Func\TrimParser());
    }
    
}