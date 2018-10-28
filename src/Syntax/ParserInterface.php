<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Exception\SyntaxErrorException;

/**
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
     * @param LexerInterface $lexer
     * @param array          $tokenType
     * @throws SyntaxErrorException
     */
    public function throwSyntaxError(LexerInterface $lexer, ...$tokenType);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isMathOperator(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isFunction(LexerInterface $lexer);
    
    /**
     * @param LexerInterface $lexer
     * @return boolean
     */
    public function isSubSelect(LexerInterface $lexer);
    
}