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
     * @return ParserInterface|MySQL\Parser\From
     */
    public function getExpressionFromParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.from');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|MySQL\Parser\Statement\Select\SelectExpression
     */
    public function getSelectExpressionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('select.select_expression');
    }
    
}