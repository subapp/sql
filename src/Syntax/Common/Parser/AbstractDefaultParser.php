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
     * @return ParserInterface|Common\Parser\Primary
     */
    public function getPrimaryParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.primary');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Identifier
     */
    public function getIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.identifier');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\QuoteIdentifier
     */
    public function getQuoteIdentifierParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.quote_identifier');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Func
     */
    public function getFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.func');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\DefaultFunction
     */
    public function getDefaultFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.default_function');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\AggregateFunction
     */
    public function getAggregateFunctionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.aggregate_function');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\FieldPath
     */
    public function getFieldPathParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.field_path');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Literal
     */
    public function getLiteralParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.literal');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Variables
     */
    public function getVariablesParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.variables');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\VariableDeclaration
     */
    public function getVariableDeclarationParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.variable_declaration');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Arguments
     */
    public function getArgumentsParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.arguments');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Complex
     */
    public function getComplexParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.complex');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Expression
     */
    public function getExpressionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.expression');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Arithmetic
     */
    public function getArithmeticParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.arithmetic');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Alias
     */
    public function getAliasParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.alias');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Embrace
     */
    public function getEmbraceParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.embrace');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\SubSelect
     */
    public function getSubSelectParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.sub_select');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\Condition
     */
    public function getConditionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('condition.condition');
    }

    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\CmpOperator
     */
    public function getCmpOperatorParser(ProcessorInterface $processor)
    {
        return $processor->getParser('condition.cmp_operator');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\Comparison
     */
    public function getComparisonParser(ProcessorInterface $processor)
    {
        return $processor->getParser('condition.comparison');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Condition\LogicOperator
     */
    public function getLogicOperatorParser(ProcessorInterface $processor)
    {
        return $processor->getParser('condition.logic_operator');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Join
     */
    public function getJoinParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.join');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\JoinCollection
     */
    public function getJoinCollectionParser(ProcessorInterface $processor)
    {
        return $processor->getParser('parser.join_collection');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\Where
     */
    public function getWhereParser(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.where');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\OrderBy
     */
    public function getOrderByParser(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.order_by');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\GroupBy
     */
    public function getGroupByParser(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.group_by');
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ParserInterface|Common\Parser\Stmt\Limit
     */
    public function getLimitParser(ProcessorInterface $processor)
    {
        return $processor->getParser('stmt.limit');
    }

}