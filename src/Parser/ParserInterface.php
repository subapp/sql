<?php

namespace Subapp\Sql\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Exception\SyntaxErrorException;

/**
 * Interface ParserInterface
 * @package Subapp\Sql\Parser
 */
interface ParserInterface
{
    
    /**
     * @param LexerInterface $lexer
     */
    public function parse(LexerInterface $lexer);
    
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
    public function isFunction(LexerInterface $lexer);
    
}