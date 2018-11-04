<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Exception\SyntaxErrorException;

/**
 * Stateless Lexer Handler
 *
 * Interface ParserInterface
 * @package Subapp\Sql\Syntax
 */
interface ParserInterface
{

    const SELECT_STATEMENT_PARSER = 'statement.select';
    const UPDATE_STATEMENT_PARSER = 'statement.update';
    const DELETE_STATEMENT_PARSER = 'statement.delete';
    
    const EXPRESSION_FROM_PARSER = 'parser.from';

    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor);
    
    /**
     * @return string
     */
    public function getName();

    /**
     * @param integer $token
     * @param LexerInterface $lexer
     */
    public function shift($token, LexerInterface $lexer);

    /**
     * @param LexerInterface $lexer
     * @param array $tokens
     */
    public function shiftAny(LexerInterface $lexer, array $tokens);

    /**
     * @param LexerInterface $lexer
     * @param array $tokens
     */
    public function shiftAnyIf(LexerInterface $lexer, array $tokens);

    /**
     * @param                $token
     * @param LexerInterface $lexer
     */
    public function shiftIf($token, LexerInterface $lexer);
    
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
    public function isMathExpression(LexerInterface $lexer);

    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isMathOperator(LexerInterface $lexer);

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
     * @return mixed
     */
    public function isIdentifier(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return mixed
     */
    public function isBraced(LexerInterface $lexer);

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
    
}