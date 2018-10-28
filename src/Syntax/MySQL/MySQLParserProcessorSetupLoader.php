<?php

namespace Subapp\Sql\Syntax\MySQL;

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
        // SELECT Parsers
        $processor->addParser(new Parser\Statement\Select());
        $processor->addParser(new Parser\Statement\Select\SelectExpression());
        
        // Base expressions parser
        $processor->addParser(new Parser\Identifier());
        
        // Common expression parsers
        $processor->addParser(new Parser\From());
        
        // Default MySQL function parsers
        $processor->addParser(new Parser\Func\TrimParser());
    }
    
}