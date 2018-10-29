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
        $token = $lexer->peek();
        $isFunction = ($token->is(Lexer::T_IDENTIFIER) && $lexer->peek()->is(Lexer::T_DOT));
        $lexer->resetPeek();

        return $isFunction;
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
        }

        $lexer->peekBeyond(Lexer::T_OPEN_BRACE, Lexer::T_CLOSE_BRACE, false);
        $isMathOperator = $this->isMathOperator($lexer);
        $lexer->resetPeek();

        return $isMathOperator;
    }

    /**
     * @inheritdoc
     */
    public function isMathOperator(LexerInterface $lexer)
    {
        $token = $lexer->peek();
        $isMath = in_array($token->getType(), [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_DIVIDE, Lexer::T_MULTIPLY,], true);
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
    protected function match($token, LexerInterface $lexer)
    {
        $lexer->toToken($token) || $this->throwSyntaxError($lexer, $token);
    }

    /**
     * @param                $token
     * @param LexerInterface $lexer
     */
    protected function matchIf($token, LexerInterface $lexer)
    {
        $lexer->toToken($token);
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
    public function renderToToken(LexerInterface $lexer, $type)
    {
        return $this->helper->renderToToken($lexer, $type);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->helper->createName(static::class);
    }

}