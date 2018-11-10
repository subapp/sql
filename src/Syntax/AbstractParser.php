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
        $isFieldPath = ($isIdentifier && $lexer->isTokenNearby(Lexer::T_DOT, 2));
        
        $lexer->resetPeek();
        
        return $isFieldPath;
    }
    
    /**
     * @inheritdoc
     */
    public function isBraced(LexerInterface $lexer)
    {
        return $lexer->isNext(Lexer::T_OPEN_BRACE);
    }
    
    /**
     * @inheritdoc
     */
    public function isIdentifier(LexerInterface $lexer)
    {
        $isIdentifier = ($lexer->peek()->is(Lexer::T_IDENTIFIER));
        $lexer->resetPeek();
        
        return $isIdentifier;
    }
    
    /**
     * @inheritdoc
     */
    public function isQuoteIdentifier(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isQuoteIdentifier = ($token->is(Lexer::T_GRAVE_ACCENT) && $this->isIdentifier($lexer));
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
        $isLiteral = in_array($token->getType(), $tokens);
        $lexer->resetPeek();
        
        return $isLiteral;
    }
    
    /**
     * @inheritdoc
     */
    public function isMathExpression(LexerInterface $lexer)
    {
        $this->peekBehindExpression($lexer);
        
        return $this->isMathOperator($lexer);
    }
    
    /**
     * @inheritdoc
     */
    public function isMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $operators = [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE,];
        $isMath = $token && in_array($token->getType(), $operators, true);
        
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isPlainMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = ($token->is(Lexer::T_PLUS) || $token->is(Lexer::T_MINUS));
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isFactorMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = ($token->is(Lexer::T_DIVIDE) || $token->is(Lexer::T_MULTIPLY));
        $lexer->resetPeek();
        
        return $isMath;
    }
    
    /**
     * @inheritdoc
     */
    public function isFunction(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isFunction = ($token->is(Lexer::T_IDENTIFIER) && $lexer->peek()->is(Lexer::T_OPEN_BRACE));
        $lexer->resetPeek();
        
        return $isFunction;
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
        $isSubSelect = ($lexer->peek()->is(Lexer::T_OPEN_BRACE) && $lexer->peek()->is(Lexer::T_SELECT));
        
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
        $token = $lexer->peek();
    
        $isOrderBy = $token && $token->is(Lexer::T_ORDER);
        $isOrderBy = $isOrderBy && $lexer->peek()->is(Lexer::T_BY);
     
        $lexer->resetPeek();
        
        return $isOrderBy;
    }
    
    /**
     * @inheritdoc
     */
    public function isGroupBy(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        
        $isGroupBy = $token && $token->is(Lexer::T_GROUP);
        $isGroupBy = $isGroupBy && $lexer->peek()->is(Lexer::T_BY);
    
        $lexer->resetPeek();
        
        return $isGroupBy;
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
        $token = $lexer->peek();
        $isAnd = $token->is(Lexer::T_AND);
        
        $lexer->resetPeek();
        
        return $isAnd;
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicOr(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isOr = $token->is(Lexer::T_OR);
        
        $lexer->resetPeek();
        
        return $isOr;
    }
    
    /**
     * @inheritdoc
     */
    public function isLogicXor(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isXor = $token->is(Lexer::T_XOR);
        
        $lexer->resetPeek();
        
        return $isXor;
    }
    
    /**
     * @inheritdoc
     */
    public function isComparisonExpression(LexerInterface $lexer)
    {
        $this->peekBehindExpression($lexer);
        $isComparison = $this->isComparisonOperator($lexer);
        
        return $isComparison;
    }
    
    /**
     * @inheritdoc
     */
    public function isComparisonOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $comparators = [Lexer::T_EQ, Lexer::T_NE, Lexer::T_GT, Lexer::T_GE, Lexer::T_LT, Lexer::T_LE,];
        $isCmp = $token && in_array($token->getType(), $comparators);
        
        $lexer->resetPeek();
        
        return $isCmp;
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
     * @param LexerInterface $lexer
     * @return TokenInterface
     */
    public function peekBehindExpression(LexerInterface $lexer)
    {
        // peek behind expressions
        // func(u.id) + 1 or (1 + 2) < 4
        // for catch logical or arithmetic operators
        if ($this->isFunction($lexer) || $lexer->isNext(Lexer::T_OPEN_BRACE)) {
            $lexer->peek();
        } elseif ($this->isFieldPath($lexer)) {
            // @todo dirty hack for peek behind [u.id] expression
            $lexer->setPeek(2);
        }
    
        $token = $lexer->peekBeyond(Lexer::T_OPEN_BRACE, Lexer::T_CLOSE_BRACE, false);
        
        $this->notEndOfLine($lexer, $token, Lexer::T_CLOSE_BRACE);
        
        return $token;
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
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->helper->getUnderscore(static::class);
    }
    
}