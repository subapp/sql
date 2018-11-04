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
        $processor->addParser(new Parser\SubSelect());
        $processor->addParser(new Parser\Arguments());
        $processor->addParser(new Parser\Arithmetic());
        $processor->addParser(new Parser\Arithmetic());
        $processor->addParser(new Parser\Identifier());
        $processor->addParser(new Parser\QuoteIdentifier());
        $processor->addParser(new Parser\Alias());
        $processor->addParser(new Parser\Literal());
        $processor->addParser(new Parser\FieldPath());
        $processor->addParser(new Parser\Complex());
        $processor->addParser(new Parser\Embrace());
        $processor->addParser(new Parser\Expression());
        $processor->addParser(new Parser\Primary());

        // functions
        $processor->addParser(new Parser\Func());
        $processor->addParser(new Parser\AggregateFunction());
        $processor->addParser(new Parser\DefaultFunction());

        // Common expression parsers
        $processor->addParser(new Parser\From());
    }
    
}