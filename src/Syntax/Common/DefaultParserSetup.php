<?php

namespace Subapp\Sql\Syntax\Common;

use Subapp\Sql\Syntax\ParserSetupInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultParserSetup
 * @package Subapp\Sql\Syntax\Default
 */
class DefaultParserSetup implements ParserSetupInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor)
    {
        // Base expressions parser
        $processor->addParser(new Parser\Variables());
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

        // conditions
        $processor->addParser(new Parser\Condition\CmpOperator());
        $processor->addParser(new Parser\Condition\Condition());
        $processor->addParser(new Parser\Condition\Comparison());
    }
    
}