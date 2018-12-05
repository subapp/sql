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

    const PARSER_A                        = 'PARSER_A';
    const PARSER_B                        = 'PARSER_B';
    const PARSER_C                        = 'PARSER_C';
    const PARSER_D                        = 'PARSER_D';
    const PARSER_AGGREGATE_FUNCTION       = 'PARSER_AGGREGATE_FUNCTION';
    const PARSER_ASSIGNMENT               = 'PARSER_ASSIGNMENT';
    const PARSER_ASSIGNMENT_LIST          = 'PARSER_ASSIGNMENT_LIST';
    const PARSER_ALIAS                    = 'PARSER_ALIAS';
    const PARSER_ARGUMENTS                = 'PARSER_ARGUMENTS';
    const PARSER_ARITHMETIC               = 'PARSER_ARITHMETIC';
    const PARSER_CONDITION_CMP_OPERATOR   = 'PARSER_CONDITION_CMP_OPERATOR';
    const PARSER_CONDITION_CONDITIONAL    = 'PARSER_CONDITION_CONDITIONAL';
    const PARSER_CONDITION_LOGIC_OPERATOR = 'PARSER_CONDITION_LOGIC_OPERATOR';
    const PARSER_CONDITION_PREDICATE      = 'PARSER_CONDITION_PREDICATE';
    const PARSER_DEFAULT_FUNCTION         = 'PARSER_DEFAULT_FUNCTION';
    const PARSER_EMBRACE                  = 'PARSER_EMBRACE';
    const PARSER_FIELD_PATH               = 'PARSER_FIELD_PATH';
    const PARSER_FUNC                     = 'PARSER_FUNC';
    const PARSER_IDENTIFIER               = 'PARSER_IDENTIFIER';
    const PARSER_LITERAL                  = 'PARSER_LITERAL';
    const PARSER_PARAMETER                = 'PARSER_PARAMETER';
    const PARSER_QUOTE_IDENTIFIER         = 'PARSER_QUOTE_IDENTIFIER';
    const PARSER_STAR                     = 'PARSER_STAR';
    const PARSER_STMT_DELETE              = 'PARSER_STMT_DELETE';
    const PARSER_STMT_FROM                = 'PARSER_STMT_FROM';
    const PARSER_STMT_GROUP_BY            = 'PARSER_STMT_GROUP_BY';
    const PARSER_STMT_INSERT              = 'PARSER_STMT_INSERT';
    const PARSER_STMT_JOIN                = 'PARSER_STMT_JOIN';
    const PARSER_STMT_JOIN_ITEMS          = 'PARSER_STMT_JOIN_ITEMS';
    const PARSER_STMT_LIMIT               = 'PARSER_STMT_LIMIT';
    const PARSER_STMT_MODIFIER            = 'PARSER_STMT_MODIFIER';
    const PARSER_STMT_ORDER_BY            = 'PARSER_STMT_ORDER_BY';
    const PARSER_STMT_SELECT              = 'PARSER_STMT_SELECT';
    const PARSER_STMT_SET                 = 'PARSER_STMT_SET';
    const PARSER_STMT_TABLE_REFERENCE     = 'PARSER_STMT_TABLE_REFERENCE';
    const PARSER_STMT_UPDATE              = 'PARSER_STMT_UPDATE';
    const PARSER_STMT_WHERE               = 'PARSER_STMT_WHERE';
    const PARSER_SUB_SELECT               = 'PARSER_SUB_SELECT';
    const PARSER_UNCOVER                  = 'PARSER_UNCOVER';
    const PARSER_VARIABLE                 = 'PARSER_VARIABLE';
    const PARSER_VARIABLES                = 'PARSER_VARIABLES';
    
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