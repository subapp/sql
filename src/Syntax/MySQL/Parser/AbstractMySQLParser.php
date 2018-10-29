<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Sql\Syntax\AbstractParser;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AbstractMySQLParser
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
abstract class AbstractMySQLParser extends AbstractParser
{
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Identifier
     */
    public function getIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.identifier');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\OrdinaryFunction
     */
    public function getOrdinaryFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.ordinary_function');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\From
     */
    public function getFromParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.from');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\FieldPath
     */
    public function getFieldPathParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.field_path');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Literal
     */
    public function getLiteralParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.literal');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Variables
     */
    public function getVariablesParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.variables');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Expression
     */
    public function getExpressionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.expression');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Arithmetic
     */
    public function getArithmeticParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.arithmetic');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Operand
     */
    public function getMathOperandParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.operand');
    }
    
}