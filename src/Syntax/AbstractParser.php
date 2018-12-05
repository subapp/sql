<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Lexer\TokenInterface;
use Subapp\Sql\Lexer\Lexer;

/**
 * Class AbstractParser
 * @package Subapp\Sql\Syntax
 */
abstract class AbstractParser implements ParserInterface
{
    
    const MATH_TOKENS    = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
    const LOGICAL_TOKENS = [Lexer::T_AND, Lexer::T_OR, Lexer::T_XOR,];
    const CMP_TOKENS     = [
        // primary
        Lexer::T_EQ, Lexer::T_NE,
        Lexer::T_GT, Lexer::T_GE,
        Lexer::T_LT, Lexer::T_LE,
        // special
        Lexer::T_IN, Lexer::T_IS,
        Lexer::T_NOT, Lexer::T_LIKE,
        Lexer::T_BETWEEN,
    ];
    /**
     * @var ParserHelper
     */
    private $helper;
    
    /**
     * AbstractParser constructor.
     */
    public function __construct()
    {
        $this->helper = new ParserHelper();
    }
    
    /**
     * @inheritdoc
     */
    public function isFieldPath(LexerInterface $lexer)
    {
        $isIdentifier = ($this->isIdentifier($lexer) || $this->isQuoteIdentifier($lexer));
        
        // trying to reach [`u`.id] Lexer::T_DOT token that located after quoted identifier
        $isFieldPath = ($isIdentifier && $lexer->isTokenNearby(Lexer::T_DOT, 4));
        
        $lexer->resetPeek();
        
        return $isFieldPath;
    }
    
    /**
     * @inheritdoc
     */
    public function isOpenBrace(LexerInterface $lexer, $resetPeek = true)
    {
        return $this->isPeekToken($lexer, $resetPeek, Lexer::T_OPEN_BRACE);
    }
    
    /**
     * @inheritdoc
     */
    public function isIdentifier(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isIdentifier = ($token && $token->is(Lexer::T_IDENTIFIER));
        $lexer->resetPeek();
        
        return $isIdentifier;
    }
    
    /**
     * @inheritdoc
     */
    public function isStar(LexerInterface $lexer, $resetPeek = true)
    {
        return $this->isPeekToken($lexer, $resetPeek, Lexer::T_MULTIPLY);
    }
    
    /**
     * @inheritdoc
     */
    public function isQuoteIdentifier(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isQuoteIdentifier = ($token && $token->is(Lexer::T_GRAVE_ACCENT) && $this->isIdentifier($lexer));
        $lexer->resetPeek();
        
        return $isQuoteIdentifier;
    }
    
    /**
     * @inheritdoc
     */
    public function isLiteral(LexerInterface $lexer)
    {
        $tokens = [Lexer::T_INT, Lexer::T_FLOAT, Lexer::T_STRING, Lexer::T_TRUE, Lexer::T_FALSE, Lexer::T_NULL,];
        
        $token = $lexer->peek();
        $isLiteral = ($token && in_array($token->getType(), $tokens));
        $lexer->resetPeek();
        
        return $isLiteral;
    }
    
    /**
     * @inheritdoc
     */
    public function isParameter(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isParameter = ($token && ($token->is(Lexer::T_QUESTION) || $token->is(Lexer::T_COLON)));
        $lexer->resetPeek();
        
        return $isParameter;
    }
    
    /**
     * @inheritdoc
     */
    public function isMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        
        $operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
        $isMath = ($token && in_array($token->getType(), $operators, true));
        
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isMathExpression(LexerInterface $lexer)
    {
        $operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
        
        $isMathExpression = (
            $this->isTokenBehindExpression($lexer, true, ...$operators)
            ||
            $this->isTokenBetweenBraces($lexer, true, ...$operators)
        );
        
        return $isMathExpression;
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicalExpression(LexerInterface $lexer)
    {
        $operators = [Lexer::T_AND, Lexer::T_OR, Lexer::T_XOR,];
        
        $isLogicalExpression = (
            $this->isTokenBehindExpression($lexer, true, ...$operators)
            ||
            $this->isTokenBetweenBraces($lexer, true, ...$operators)
        );
        
        return $isLogicalExpression;
    }
    
    /**
     * @inheritdoc
     */
    public function isNotMathExpression(LexerInterface $lexer)
    {
        return !$this->isMathExpression($lexer);
    }
    
    /**
     * @inheritdoc
     */
    public function isPlainMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = ($token && $token->is(Lexer::T_PLUS) || $token->is(Lexer::T_MINUS));
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isFactorMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = ($token && ($token->is(Lexer::T_DIVIDE) || $token->is(Lexer::T_MULTIPLY)));
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isFunction(LexerInterface $lexer)
    {
        return $this->isPeekSequence($lexer, Lexer::T_IDENTIFIER, Lexer::T_OPEN_BRACE);
    }
    
    /**
     * @inheritdoc
     */
    public function isAlias(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isAlias = $token && ($token->is(Lexer::T_IDENTIFIER) || $token->is(Lexer::T_AS));
        $lexer->resetPeek();
        
        return $isAlias;
    }
    
    /**
     * @inheritdoc
     */
    public function isSubSelect(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isSubSelect = ($token && $token->is(Lexer::T_OPEN_BRACE) && $lexer->peek()->is(Lexer::T_SELECT));
        
        $lexer->resetPeek();
        
        return $isSubSelect;
    }
    
    /**
     * @inheritdoc
     */
    public function isJoin(LexerInterface $lexer)
    {
        if ($lexer->isNextAny([Lexer::T_LEFT, Lexer::T_INNER, Lexer::T_RIGHT, Lexer::T_OUTER,])) {
            $lexer->peek();
        }
        
        $token = $lexer->peek();
        $isJoin = $token && $token->is(Lexer::T_JOIN);
        $lexer->resetPeek();
        
        return $isJoin;
    }
    
    /**
     * @inheritdoc
     */
    public function isWhere(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isWhere = $token && $token->is(Lexer::T_WHERE);
        $lexer->resetPeek();
        
        return $isWhere;
    }
    
    /**
     * @inheritdoc
     */
    public function isOrderBy(LexerInterface $lexer)
    {
        $hasToken = $this->isPeekSequence($lexer, Lexer::T_ORDER, Lexer::T_BY);
        
        $lexer->resetPeek();
        
        return $hasToken;
    }
    
    /**
     * @inheritdoc
     */
    public function isGroupBy(LexerInterface $lexer)
    {
        $hasToken = $this->isPeekSequence($lexer, Lexer::T_GROUP, Lexer::T_BY);
        
        $lexer->resetPeek();
        
        return $hasToken;
    }
    
    /**
     * @inheritdoc
     */
    public function isLimit(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isLimit = $token && $token->is(Lexer::T_LIMIT);
        $lexer->resetPeek();
        
        return $isLimit;
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicalOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $operators = [Lexer::T_AND, Lexer::T_OR, Lexer::T_XOR,];
        $isLogical = $token && in_array($token->getType(), $operators, true);
        
        $lexer->resetPeek();
        
        return $isLogical;
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicAnd(LexerInterface $lexer)
    {
        return $this->isPeekToken($lexer, true, Lexer::T_AND);
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicOr(LexerInterface $lexer)
    {
        return $this->isPeekToken($lexer, true, Lexer::T_OR);
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicXor(LexerInterface $lexer)
    {
        return $this->isPeekToken($lexer, true, Lexer::T_XOR);
    }
    
    /**
     * @inheritdoc
     */
    public function isComparisonExpression(LexerInterface $lexer)
    {
        $operators = [
            Lexer::T_EQ, Lexer::T_NE, Lexer::T_GT, Lexer::T_GE, Lexer::T_LT, Lexer::T_LE, // primary
            Lexer::T_NOT, Lexer::T_BETWEEN, Lexer::T_IN, Lexer::T_IS, Lexer::T_LIKE, // special
        ];
        
        $isComparison = (
            $this->isTokenBehindBraces($lexer, true, ...$operators)
            || $this->isTokenBehindExpression($lexer, true, ...$operators)
            || $this->isTokenBetweenBraces($lexer, true, ...$operators)
        );
        
        return $isComparison;
    }
    
    /**
     * @inheritdoc
     */
    public function isComparisonOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $comparators = [Lexer::T_EQ, Lexer::T_NE, Lexer::T_GT, Lexer::T_GE, Lexer::T_LT, Lexer::T_LE,];
        $isComparison = $token && in_array($token->getType(), $comparators);
        
        $lexer->resetPeek();
        
        return $isComparison;
    }
    
    /**
     * @inheritdoc
     */
    public function isExtraComparisonOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $comparators = [Lexer::T_NOT, Lexer::T_BETWEEN, Lexer::T_IN, Lexer::T_IS, Lexer::T_LIKE,];
        $isComparison = $token && in_array($token->getType(), $comparators);
        
        $lexer->resetPeek();
        
        return $isComparison;
    }
    
    /**
     * @inheritdoc
     */
    public function isIn(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        
        // skip NOT that can be before [NOT] IN()
        if ($token->is(Lexer::T_NOT)) {
            $token = $lexer->peek();
        }
        
        $this->notEndOfLine($lexer, $token, Lexer::T_IN);
        
        $isIn = $token->is(Lexer::T_IN);
        
        // reset peek position = 0
        $lexer->resetPeek();
        
        return $isIn;
    }
    
    /**
     * @inheritdoc
     */
    public function isIsNull(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isIsNull = $token && $token->is(Lexer::T_IS);
        $token = $lexer->peek();
        
        // skip NOT that can be before IS [NOT] NULL
        if ($token->is(Lexer::T_NOT)) {
            $token = $lexer->peek();
        }
        
        $this->notEndOfLine($lexer, $token, Lexer::T_NOT, Lexer::T_NULL);
        
        // IS NULL | IS NOT NULL
        $isIsNull = $isIsNull && $token->is(Lexer::T_NULL);
        
        // reset peek position = 0
        $lexer->resetPeek();
        
        return $isIsNull;
    }
    
    /**
     * @inheritdoc
     */
    public function isBetween(LexerInterface $lexer)
    {
        // if next token between
        $token = $lexer->peek();
        
        // skip NOT token that can be before [NOT] BETWEEN ... AND ...
        if ($token->is(Lexer::T_NOT)) {
            $token = $lexer->peek();
        }
        
        $isBetween = $token && $token->is(Lexer::T_BETWEEN);
        
        $this->notEndOfLine($lexer, $token, Lexer::T_STRING, Lexer::T_NOT);
        
        // reset peek position = 0
        $lexer->resetPeek();
        
        return $isBetween;
    }
    
    /**
     * @inheritdoc
     */
    public function isLike(LexerInterface $lexer)
    {
        // if next token between
        $token = $lexer->peek();
        
        // skip NOT token that can be before [NOT] LIKE 'john%'
        if ($token->is(Lexer::T_NOT)) {
            $token = $lexer->peek();
        }
        
        $isLike = $token && $token->is(Lexer::T_LIKE);
        
        $this->notEndOfLine($lexer, $token, Lexer::T_LIKE, Lexer::T_NOT);
        
        // reset peek position = 0
        $lexer->resetPeek();
        
        return $isLike;
    }

    /**
     * @inheritdoc
     */
    public function isMatchAgainst(LexerInterface $lexer)
    {
        // if next token between
        $token = $lexer->peek();

        $isMatch = $token && $token->is(Lexer::T_MATCH);
        $isMatch = $isMatch && $this->isTokenBehindBraces($lexer, true, Lexer::T_AGAINST);

        $lexer->resetPeek();

        return $isMatch;
    }
    
    /**
     * @inheritDoc
     */
    public function isExpressionWithAlias(LexerInterface $lexer)
    {
        return $this->isTokenBehindExpression($lexer, true, Lexer::T_IDENTIFIER, Lexer::T_AS);
    }
    
    /**
     * @inheritDoc
     */
    public function isExpressionWithComma(LexerInterface $lexer)
    {
        return $this->isTokenBehindExpression($lexer, true, Lexer::T_COMMA);
    }
    
    /**
     * @inheritdoc
     */
    public function isTokenBetweenBraces(LexerInterface $lexer, $reset = true, ...$tokens)
    {
        $hasToken = false;
        
        if ($this->isOpenBrace($lexer)) {
            $lexer->peek();
            $hasToken = $this->isTokenBehindExpression($lexer, false, ...$tokens);
        }
        
        $lexer->resetPeek();
        
        return $hasToken;
    }
    
    /**
     * @inheritdoc
     */
    public function isTokenBehindBraces(LexerInterface $lexer, $reset = true, ...$tokens)
    {
        $peekValue = $lexer->getPeek();
        $this->peekBehindBraces($lexer);
        $hasToken = $this->isPeekToken($lexer, $reset, ...$tokens);
        $lexer->setPeek($peekValue);
        
        return $hasToken;
    }
    
    /**
     * @inheritDoc
     */
    public function isTokenBehindFunction(LexerInterface $lexer, $reset = true, ...$tokens)
    {
        $peekValue = $lexer->getPeek();
        $this->peekBehindFunction($lexer);
        $hasToken = $this->isPeekToken($lexer, $reset, ...$tokens);
        $lexer->setPeek($peekValue);
        
        return $hasToken;
    }
    
    /**
     * @inheritDoc
     */
    public function isTokenBehindFieldIdentifier(LexerInterface $lexer, $reset = true, ...$tokens)
    {
        $peekValue = $lexer->getPeek();
        $this->peekBehindFieldIdentifier($lexer);
        $hasToken = $this->isPeekToken($lexer, $reset, ...$tokens);
        $lexer->setPeek($peekValue);
        
        return $hasToken;
    }
    
    /**
     * @inheritDoc
     */
    public function isTokenBehindLiteral(LexerInterface $lexer, $reset = true, ...$tokens)
    {
        $peekValue = $lexer->getPeek();
        $this->peekBehindLiteral($lexer);
        $hasToken = $this->isPeekToken($lexer, $reset, ...$tokens);
        $lexer->setPeek($peekValue);
        
        return $hasToken;
    }
    
    /**
     * @inheritdoc
     */
    public function isTokenBehindExpression(LexerInterface $lexer, $resetPeek = true, ...$tokens)
    {
        $hasToken = (
            $this->isTokenBehindLiteral($lexer, $resetPeek, ...$tokens)
            ||
            $this->isTokenBehindFieldIdentifier($lexer, $resetPeek, ...$tokens)
            ||
            $this->isTokenBehindFunction($lexer, $resetPeek, ...$tokens)
            ||
            $this->isTokenBehindBraces($lexer, $resetPeek, ...$tokens)
        );
        
        return $hasToken;
    }
    
    /**
     * @inheritdoc
     */
    public function isPeekToken(LexerInterface $lexer, $resetPeek = true, ...$tokens)
    {
        $token = $lexer->peek();
        $isSatisfied = ($token && in_array($token->getType(), $tokens, true));
        
        if ($resetPeek) {
            $lexer->resetPeek();
        }
        
        return $isSatisfied;
    }
    
    /**
     * @inheritdoc
     */
    public function isPeekSequence(LexerInterface $lexer, ...$tokens)
    {
        $isSatisfied = true;
        
        foreach ($tokens as $tokenType) {
            $token = $lexer->peek();
            $isSatisfied = ($isSatisfied && $token && $token->is($tokenType));
        }
        
        $lexer->resetPeek();
        
        return $isSatisfied;
    }
    
    /**
     * @inheritdoc
     */
    public function isPeekAgainst(LexerInterface $lexer, array $needed, array $against)
    {
        $isFounded = false;
        
        while (($token = $lexer->peek()) && !$isFounded && !in_array($token->getType(), $against, true)) {
            $isFounded = in_array($token->getType(), $needed, true);
        }
        
        return $isFounded;
    }
    
    /**
     * @inheritdoc
     */
    public function peekBehindFunction(LexerInterface $lexer)
    {
        $peekValue = $lexer->getPeek();
        
        // if expression starts with: (Cos(a + 1) / 3)
        $isFunction = $this->isFunction($lexer);
        $lexer->setPeek($peekValue);
        
        if ($isFunction) {
            $lexer->peek();
            $lexer->peekBeyond(Lexer::T_OPEN_BRACE, Lexer::T_CLOSE_BRACE, false);
        }
    }
    
    /**
     * @inheritdoc
     */
    public function peekBehindBraces(LexerInterface $lexer)
    {
        $peekValue = $lexer->getPeek();
        
        // if expression starts with: (a + 1) / 3
        $isOpenBrace = $this->isPeekToken($lexer, false, Lexer::T_OPEN_BRACE);
        $lexer->setPeek($peekValue);
        
        if ($isOpenBrace) {
            $lexer->peekBeyond(Lexer::T_OPEN_BRACE, Lexer::T_CLOSE_BRACE, false);
        }
    }
    
    /**
     * @inheritdoc
     */
    public function peekBehindFieldIdentifier(LexerInterface $lexer)
    {
        $peekValue = $lexer->getPeek();
        
        // if expression starts with: u.id / 22
        $isFieldPath = $this->isFieldPath($lexer);
        $lexer->setPeek($peekValue);
        
        // if expression starts with: ID
        $isIdentifier = $this->isIdentifier($lexer);
        $lexer->setPeek($peekValue);
        
        if ($isFieldPath || $isIdentifier) {
            $isFieldPath ? $lexer->increasePeek(3) : $lexer->peek();
        }
    }
    
    /**
     * @inheritdoc
     */
    public function peekBehindLiteral(LexerInterface $lexer)
    {
        $peekValue = $lexer->getPeek();
        
        // if expression starts with: 22 / 7
        $isLiteral = $this->isLiteral($lexer);
        $lexer->setPeek($peekValue);
        
        if ($isLiteral) {
            $lexer->peek();
        }
    }
    
    /**
     * @param LexerInterface           $lexer
     * @param                          $token
     * @param array|integer[]|string[] $expected
     */
    public function notEndOfLine(LexerInterface $lexer, $token, ...$expected)
    {
        $isToken = ($token instanceof TokenInterface);
        
        // syntax error if end-of-line detected
        if ($isToken == false) {
            $this->throwSyntaxError($lexer, ...$expected);
        }
    }
    
    /**
     * @inheritdoc
     */
    public function shift($token, LexerInterface $lexer)
    {
        $lexer->toToken($token) || $this->throwSyntaxError($lexer, $token);
    }
    
    /**
     * @inheritdoc
     */
    public function shiftIf($token, LexerInterface $lexer)
    {
        $lexer->toToken($token);
    }
    
    /**
     * @inheritdoc
     */
    public function shiftUntil($token, LexerInterface $lexer)
    {
        $occurrences = 0;
        
        while ($lexer->toToken($token)) {
            $occurrences++;
        }
        
        return $occurrences;
    }
    
    /**
     * @inheritdoc
     */
    public function shiftForNTimes($occurrences, LexerInterface $lexer)
    {
        while ($occurrences-- > 0 && $lexer->next()) ;
    }
    
    /**
     * @inheritdoc
     */
    public function shiftAny(LexerInterface $lexer, array $tokens)
    {
        $lexer->toTokenAny($tokens) || $this->throwSyntaxError($lexer, ...$tokens);
    }
    
    /**
     * @inheritdoc
     */
    public function shiftAnyIf(LexerInterface $lexer, array $tokens)
    {
        $lexer->toTokenAny($tokens);
    }
    
    /**
     * @inheritdoc
     */
    public function throwSyntaxError(LexerInterface $lexer, ...$tokenType)
    {
        $this->helper->throwSyntaxError($lexer, $this, ...$tokenType);
    }
    
    /**
     * @param LexerInterface $lexer
     * @param integer        $type
     * @return string
     */
    public function getStringToToken(LexerInterface $lexer, $type)
    {
        return $this->helper->getStringToToken($lexer, $type);
    }
    
    /**
     * @param LexerInterface $lexer
     * @param integer        $length
     * @return string
     */
    public function getStringLength(LexerInterface $lexer, $length)
    {
        return $this->helper->getStringLength($lexer, $length);
    }
    
}