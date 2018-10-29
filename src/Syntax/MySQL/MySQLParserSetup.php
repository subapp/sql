<?php

namespace Subapp\Sql\Syntax\MySQL;

use Subapp\Sql\Syntax\MySQL\Parser;
use Subapp\Sql\Syntax\ParserSetupInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class MySQLParserProcessorSetupLoader
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class MySQLParserSetup implements ParserSetupInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor)
    {
        // SELECT Parsers
        $processor->addParser(new Parser\Statement\Select());
        $processor->addParser(new Parser\Variables());
        
        // Base expressions parser
        $processor->addParser(new Parser\Operand());
        $processor->addParser(new Parser\Arithmetic());
        $processor->addParser(new Parser\Identifier());
        $processor->addParser(new Parser\Literal());
        $processor->addParser(new Parser\FieldPath());
        $processor->addParser(new Parser\Expression());
        $processor->addParser(new Parser\OrdinaryFunction());
        
        // Common expression parsers
        $processor->addParser(new Parser\From());
    }
    
}