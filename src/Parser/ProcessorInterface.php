<?php

namespace Subapp\Sql\Parser;

use Subapp\Collection\CollectionInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Platform\PlatformInterface;

/**
 * Class ParserProcessor
 * @package Subapp\Sql
 */
interface ProcessorInterface
{
    
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
     * @param $name
     * @return ParserInterface
     * @throws \InvalidArgumentException
     */
    public function getParser($name);
    
    /**
     * @return ExpressionInterface
     */
    public function parse();
    
    /**
     * @return LexerInterface
     */
    public function getLexer();
    
    /**
     * @return PlatformInterface
     */
    public function getPlatform();
    
    /**
     * @return CollectionInterface|ParserInterface[]
     */
    public function getParsers();
    
}