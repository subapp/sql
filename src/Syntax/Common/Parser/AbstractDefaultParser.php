<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Sql\Syntax\AbstractParser;
use Subapp\Sql\Syntax\Common;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class AbstractDefaultParser
 * @package Subapp\Sql\Syntax\Common\Parser
 */
abstract class AbstractDefaultParser extends AbstractParser
{
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Common
     */
    
    public function getCommonParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_COMMON);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Primary
     */
    public function getPrimaryParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_PRIMARY);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Identifier
     */
    public function getIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_IDENTIFIER);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Star
     */
    public function getStarParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STAR);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\QuoteIdentifier
     */
    public function getQuoteIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_QUOTE_IDENTIFIER);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Func
     */
    public function getFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_FUNC);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\DefaultFunction
     */
    public function getDefaultFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_DEFAULT_FUNCTION);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\AggregateFunction
     */
    public function getAggregateFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_AGGREGATE_FUNCTION);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\FieldPath
     */
    public function getFieldPathParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_FIELD_PATH);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Literal
     */
    public function getLiteralParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_LITERAL);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Parameter
     */
    public function getParameterParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_PARAMETER);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Variables
     */
    public function getVariablesParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_VARIABLES);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Variable
     */
    public function getVariableParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_VARIABLE);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Arguments
     */
    public function getArgumentsParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_ARGUMENTS);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Complex
     */
    public function getComplexParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_COMPLEX);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Expression
     */
    public function getExpressionParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_EXPRESSION);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Arithmetic
     */
    public function getArithmeticParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_ARITHMETIC);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Alias
     */
    public function getAliasParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_ALIAS);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Embrace
     */
    public function getEmbraceParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_EMBRACE);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\SubSelect
     */
    public function getSubSelectParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_SUB_SELECT);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\Conditional
     */
    public function getConditionalParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_CONDITION_CONDITIONAL);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\CmpOperator
     */
    public function getCmpOperatorParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_CONDITION_CMP_OPERATOR);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\Predicate
     */
    public function getPredicateParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_CONDITION_PREDICATE);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\LogicOperator
     */
    public function getLogicOperatorParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_CONDITION_LOGIC_OPERATOR);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\Join
     */
    public function getJoinParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_JOIN);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\JoinItems
     */
    public function getJoinItemsParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_JOIN_ITEMS);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\Where
     */
    public function getWhereParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_WHERE);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\OrderBy
     */
    public function getOrderByParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_ORDER_BY);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\GroupBy
     */
    public function getGroupByParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_GROUP_BY);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\Limit
     */
    public function getLimitParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_LIMIT);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Uncover
     */
    public function getUncoverParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_UNCOVER);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface
     */
    public function getSelectStmtParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_SELECT);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface
     */
    public function getFromStmtParser(ProcessorInterface $processor)
    {
        return $processor->getParser(self::PARSER_STMT_FROM);
    }
    
}