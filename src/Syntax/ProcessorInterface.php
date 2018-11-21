<?php

namespace Subapp\Sql\Syntax;

use Subapp\Sql\Common\CollectionInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Platform\PlatformInterface;

/**
 * Class ParserProcessor
 * @package Subapp\Sql
 */
interface ProcessorInterface
{
    
    /**
     * @param ParserSetupInterface $parserSetup
     */
    public function setup(ParserSetupInterface $parserSetup);
    
    /**
     * @param ParserInterface $parser
     */
    public function addParser(ParserInterface $parser);
    
    /**
     * @param $name
     */
    public function removeParser($name);
    
    /**
     * @param $name
     * @return boolean
     */
    public function hasParser($name);
    
    /**
     * @return void
     */
    public function cleanParsers();
    
    /**
     * @param $name
     * @return ParserInterface
     * @throws \RuntimeException
     */
    public function getParser($name);
    
    /**
     * @return NodeInterface
     */
    public function parse();
    
    /**
     * @return LexerInterface
     */
    public function getLexer();
    
    /**
     * @return CollectionInterface|ParserInterface[]
     */
    public function getParsers();
    
    /**
     * @param LexerInterface $lexer
     */
    public function setLexer(LexerInterface $lexer);
    
}