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
     * @return ParserInterface|MySQL\Parser\Primary
     */
    public function getPrimaryParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.primary');
    }
    
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
     * @return ParserInterface|MySQL\Parser\QuoteIdentifier
     */
    public function getQuoteIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.quote_identifier');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Func
     */
    public function getFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.func');
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
     * @return ParserInterface|MySQL\Parser\Arguments
     */
    public function getArgumentsParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.arguments');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Expression
     */
    public function getComplexParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.complex');
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
     * @return ParserInterface|MySQL\Parser\ArithmeticBrace
     */
    public function getArithmeticBraceParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.arithmetic_brace');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Operand
     */
    public function getOperandParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.operand');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Alias
     */
    public function getAliasParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.alias');
    }
    
}