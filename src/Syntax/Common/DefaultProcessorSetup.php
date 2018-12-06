<?php

namespace Subapp\Sql\Syntax\Common;

use Subapp\Sql\Syntax\Common\Parser;
use Subapp\Sql\Syntax\ProcessorSetupInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultProcessorSetup
 * @package Subapp\Sql\Syntax\Common
 */
class DefaultProcessorSetup implements ProcessorSetupInterface
{
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setup(ProcessorInterface $processor)
    {
        // base expressions parser
        $processor->add(new Parser\Variables());
        $processor->add(new Parser\SubSelect());
        $processor->add(new Parser\Arguments());
        $processor->add(new Parser\Arithmetic());
        $processor->add(new Parser\Arithmetic());
        $processor->add(new Parser\Identifier());
        $processor->add(new Parser\QuoteIdentifier());
        $processor->add(new Parser\Star());
        $processor->add(new Parser\Alias());
        $processor->add(new Parser\Literal());
        $processor->add(new Parser\Parameter());
        $processor->add(new Parser\FieldPath());
        $processor->add(new Parser\Embrace());
        $processor->add(new Parser\Variable());

        // complex parsers
        $processor->add(new Parser\ParserA());
        $processor->add(new Parser\ParserB());
        $processor->add(new Parser\ParserC());
        $processor->add(new Parser\ParserD());

        // helpers
        $processor->add(new Parser\Uncover());
        
        // functions
        $processor->add(new Parser\Func());
        $processor->add(new Parser\AggregateFunction());
        $processor->add(new Parser\DefaultFunction());
        
        // conditions
        $processor->add(new Parser\Condition\CmpOperator());
        $processor->add(new Parser\Condition\LogicOperator());
        $processor->add(new Parser\Condition\Conditional());
        $processor->add(new Parser\Condition\Predicate());
        
        // stmt
        $processor->add(new Parser\Stmt\Select());
        $processor->add(new Parser\Stmt\Insert());
        $processor->add(new Parser\Stmt\Update());
        $processor->add(new Parser\Stmt\Delete());
        $processor->add(new Parser\Stmt\Join());
        $processor->add(new Parser\Stmt\JoinItems());
        $processor->add(new Parser\Stmt\From());
        $processor->add(new Parser\Stmt\Where());
        $processor->add(new Parser\Stmt\OrderBy());
        $processor->add(new Parser\Stmt\GroupBy());
        $processor->add(new Parser\Stmt\Limit());
        $processor->add(new Parser\Stmt\TableReference());
        $processor->add(new Parser\Stmt\Assignment());
        $processor->add(new Parser\Stmt\AssignmentList());
        $processor->add(new Parser\Stmt\Set());
        $processor->add(new Parser\Stmt\Modifier());
        $processor->add(new Parser\Stmt\Into());
        $processor->add(new Parser\Stmt\ValueList());
    }
    
}