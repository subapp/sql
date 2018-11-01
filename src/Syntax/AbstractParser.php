<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
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
        if ($this->isFunction($lexer) || $lexer->isNext(Lexer::T_OPEN_BRACE)) {
            $lexer->peek();
        } elseif ($this->isFieldPath($lexer)) {
            // @todo dirty hack...
            $lexer->setPeek(2);
        }

        if (!$lexer->peekBeyond(Lexer::T_OPEN_BRACE, Lexer::T_CLOSE_BRACE, false)) {
            $this->throwSyntaxError($lexer, Lexer::T_CLOSE_BRACE);
        }

        return $this->isMathOperator($lexer);
    }

    /**
     * @inheritdoc
     */
    public function isMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = in_array($token->getType(), [Lexer::T_DIVIDE, Lexer::T_MULTIPLY, Lexer::T_PLUS, Lexer::T_MINUS,], true);
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
     * @param integer $token
     * @param LexerInterface $lexer
     */
    public function shift($token, LexerInterface $lexer)
    {
        $lexer->toToken($token) || $this->throwSyntaxError($lexer, $token);
    }

    /**
     * @param                $token
     * @param LexerInterface $lexer
     */
    public function shiftIf($token, LexerInterface $lexer)
    {
        $lexer->toToken($token);
    }

    /**
     * @param LexerInterface $lexer
     * @param array $tokens
     */
    public function shiftAny(LexerInterface $lexer, array $tokens)
    {
        $lexer->toTokenAny($tokens) || $this->throwSyntaxError($lexer, ...$tokens);
    }

    /**
     * @param LexerInterface $lexer
     * @param array $tokens
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
        $this->helper->throwSyntaxError($this, $lexer, ...$tokenType);
    }

    /**
     * @param LexerInterface $lexer
     * @param integer $type
     * @return string
     */
    public function getStringToToken(LexerInterface $lexer, $type)
    {
        return $this->helper->getStringToToken($lexer, $type);
    }

    /**
     * @param LexerInterface $lexer
     * @param integer $length
     * @return string
     */
    public function getStringLength(LexerInterface $lexer, $length)
    {
        return $this->helper->getStringLength($lexer, $length);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->helper->getUnderscore(static::class);
    }

}