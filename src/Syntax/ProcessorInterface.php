<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Common\Collection;
use Subapp\Sql\Context;

/**
 * Class ParserProcessor
 * @package Subapp\Sql
 */
interface ProcessorInterface
{
    
    /**
     * @param ProcessorSetupInterface $parserSetup
     */
    public function setup(ProcessorSetupInterface $parserSetup);
    
    /**
     * @param ParserInterface $parser
     */
    public function add(ParserInterface $parser);
    
    /**
     * @param $name
     */
    public function remove($name);
    
    /**
     * @param $name
     * @return boolean
     */
    public function has($name);
    
    /**
     * @return void
     */
    public function clean();
    
    /**
     * @param $name
     * @return ParserInterface
     * @throws \RuntimeException
     */
    public function getParser($name);
    
    /**
     * @return NodeInterface
     * @throws \RuntimeException
     */
    public function parse();
    
    /**
     * @return LexerInterface
     */
    public function getLexer();
    
    /**
     * @return Collection|ParserInterface[]
     */
    public function getParsers();
    
    /**
     * @param LexerInterface $lexer
     */
    public function setLexer(LexerInterface $lexer);
    
    /**
     * @return Context
     */
    public function getContext();
    
}