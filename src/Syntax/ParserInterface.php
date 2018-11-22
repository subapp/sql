<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Exception\SyntaxErrorException;

/**
 * Stateless Lexer Handler
 *
 * Interface ParserInterface
 * @package Subapp\Sql\Syntax
 */
interface ParserInterface
{
    
    const PARSER_AGGREGATE_FUNCTION       = 'Parser::AggregateFunction';
    const PARSER_ALIAS                    = 'Parser::Alias';
    const PARSER_ARGUMENTS                = 'Parser::Arguments';
    const PARSER_ARITHMETIC               = 'Parser::Arithmetic';
    const PARSER_COMMON                   = 'Parser::Common';
    const PARSER_COMPLEX                  = 'Parser::Complex';
    const PARSER_CONDITION_CMP_OPERATOR   = 'Parser::CmpOperator';
    const PARSER_CONDITION_CONDITIONAL    = 'Parser::Conditional';
    const PARSER_CONDITION_LOGIC_OPERATOR = 'Parser::LogicOperator';
    const PARSER_CONDITION_PREDICATE      = 'Parser::Predicate';
    const PARSER_DEFAULT_FUNCTION         = 'Parser::DefaultFunction';
    const PARSER_EMBRACE                  = 'Parser::Embrace';
    const PARSER_EXPRESSION               = 'Parser::Expression';
    const PARSER_FIELD_PATH               = 'Parser::FieldPath';
    const PARSER_FUNC                     = 'Parser::Func';
    const PARSER_IDENTIFIER               = 'Parser::Identifier';
    const PARSER_LITERAL                  = 'Parser::Literal';
    const PARSER_PARAMETER                = 'Parser::Parameter';
    const PARSER_PRIMARY                  = 'Parser::Primary';
    const PARSER_QUOTE_IDENTIFIER         = 'Parser::QuoteIdentifier';
    const PARSER_STAR                     = 'Parser::Star';
    const PARSER_STMT_GROUP_BY            = 'Parser::GroupBy';
    const PARSER_STMT_JOIN                = 'Parser::Join';
    const PARSER_STMT_JOIN_ITEMS          = 'Parser::JoinItems';
    const PARSER_STMT_LIMIT               = 'Parser::Limit';
    const PARSER_STMT_ORDER_BY            = 'Parser::OrderBy';
    const PARSER_STMT_WHERE               = 'Parser::Where';
    const PARSER_SUB_SELECT               = 'Parser::SubSelect';
    const PARSER_UNCOVER                  = 'Parser::Uncover';
    const PARSER_VARIABLE                 = 'Parser::Variable';
    const PARSER_VARIABLES                = 'Parser::Variables';
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor);
    
    /**
     * @return string
     */
    public function getName();
    
    /**
     * @param integer        $token
     * @param LexerInterface $lexer
     */
    public function shift($token, LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @param array          $tokens
     */
    public function shiftAny(LexerInterface $lexer, array $tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param array          $tokens
     */
    public function shiftAnyIf(LexerInterface $lexer, array $tokens);
    
    /**
     * @param                $token
     * @param LexerInterface $lexer
     */
    public function shiftIf($token, LexerInterface $lexer);
    
    /**
     * @param                $token
     * @param LexerInterface $lexer
     * @return integer
     */
    public function shiftUntil($token, LexerInterface $lexer);
    
    /**
     * @param integer        $occurrences
     * @param LexerInterface $lexer
     * @return void
     */
    public function shiftForNTimes($occurrences, LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @param array          $tokenType
     * @throws SyntaxErrorException
     */
    public function throwSyntaxError(LexerInterface $lexer, ...$tokenType);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLiteral(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isParameter(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isMathExpression(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLogicalExpression(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isComparisonExpression(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isComparisonOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isExpressionWithAlias(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isExpressionWithComma(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isExtraComparisonOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isIsNull(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLike(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isBetween(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isIn(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isMathOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return bool
     */
    public function isNotMathExpression(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isPlainMathOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isFactorMathOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isIdentifier(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isStar(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return mixed
     */
    public function isOpenBrace(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return mixed
     */
    public function isQuoteIdentifier(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isFieldPath(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isFunction(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isAlias(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isSubSelect(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isJoin(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isWhere(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isOrderBy(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isGroupBy(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLimit(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLogicalOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLogicAnd(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLogicOr(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isLogicXor(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBetweenBraces(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBehindBraces(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBehindFunction(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBehindFieldIdentifier(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBehindLiteral(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param boolean        $reset
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isTokenBehindExpression(LexerInterface $lexer, $reset = true, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isPeekToken(LexerInterface $lexer, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param integer        ...$tokens
     * @return boolean
     */
    public function isPeekSequence(LexerInterface $lexer, ...$tokens);
    
    /**
     * @param LexerInterface $lexer
     * @param array          $needed
     * @param array          $against
     * @return boolean
     */
    public function isPeekAgainst(LexerInterface $lexer, array $needed, array $against);
    
    /**
     * @param LexerInterface $lexer
     */
    public function peekBehindFunction(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     */
    public function peekBehindBraces(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     */
    public function peekBehindFieldIdentifier(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     */
    public function peekBehindLiteral(LexerInterface $lexer);
    
}