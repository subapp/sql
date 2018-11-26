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
    
    const PARSER_AGGREGATE_FUNCTION       = 2100;
    const PARSER_ALIAS                    = 2110;
    const PARSER_ARGUMENTS                = 2120;
    const PARSER_ARITHMETIC               = 2130;
    const PARSER_COMMON                   = 2140;
    const PARSER_COMPLEX                  = 2150;
    const PARSER_CONDITION_CMP_OPERATOR   = 2160;
    const PARSER_CONDITION_CONDITIONAL    = 2170;
    const PARSER_CONDITION_LOGIC_OPERATOR = 2180;
    const PARSER_CONDITION_PREDICATE      = 2190;
    const PARSER_DEFAULT_FUNCTION         = 2200;
    const PARSER_EMBRACE                  = 2210;
    const PARSER_EXPRESSION               = 2220;
    const PARSER_FIELD_PATH               = 2230;
    const PARSER_FUNC                     = 2240;
    const PARSER_IDENTIFIER               = 2250;
    const PARSER_LITERAL                  = 2260;
    const PARSER_PARAMETER                = 2270;
    const PARSER_PRIMARY                  = 2280;
    const PARSER_QUOTE_IDENTIFIER         = 2290;
    const PARSER_STAR                     = 2300;
    const PARSER_STMT_FROM                = 2310;
    const PARSER_STMT_GROUP_BY            = 2320;
    const PARSER_STMT_JOIN                = 2330;
    const PARSER_STMT_JOIN_ITEMS          = 2340;
    const PARSER_STMT_LIMIT               = 2350;
    const PARSER_STMT_ORDER_BY            = 2360;
    const PARSER_STMT_SELECT              = 2370;
    const PARSER_STMT_WHERE               = 2380;
    const PARSER_SUB_SELECT               = 2390;
    const PARSER_UNCOVER                  = 2400;
    const PARSER_VARIABLE                 = 2410;
    const PARSER_VARIABLES                = 2420;
    
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
    public function isMatchAgainst(LexerInterface $lexer);

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