<?php

namespace Subapp\Sql\Parser;

use Subapp\Collection\Collection;
use Subapp\Collection\CollectionInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Exception\SyntaxErrorException;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\PlatformInterface;

/**
 * Class ParserFacade
 * @package Subapp\Sql
 */
final class ParserFacade
{
    
    /**
     * @var LexerInterface
     */
    private $lexer;
    
    /**
     * @var PlatformInterface
     */
    private $platform;
    
    /**
     * @var CollectionInterface|ParserInterface[]
     */
    private $parsers;
    
    /**
     * Query constructor.
     * @param LexerInterface    $lexer
     * @param PlatformInterface $platform
     */
    public function __construct(LexerInterface $lexer, PlatformInterface $platform)
    {
        $this->parsers = new Collection([], ParserInterface::class);
        $this->lexer = $lexer;
        $this->platform = $platform;
    }
    
    /**
     * @param ParserInterface $parser
     */
    public function addParser(ParserInterface $parser)
    {
        $this->parsers->offsetSet($parser->getName(), $parser);
    }
    
    /**
     * @param $name
     */
    public function removeParser($name)
    {
        $this->parsers->remove($name);
    }
    
    /**
     * @param $name
     * @return boolean
     */
    public function hasParser($name)
    {
        return $this->parsers->offsetExists($name);
    }
    
    /**
     * @param $name
     * @return ParserInterface
     */
    public function getParser($name)
    {
        $parser = $this->parsers->offsetGet($name);
        
        if (!($parser instanceof ParserInterface)) {
        
        }
        
        return $parser;
    }
    
    public function parse()
    {
        $lexer = $this->getLexer();
        
        // reset lexer to start
        $lexer->rewind();
        
        // determine which of statement will be parsed
        switch (true) {
            case ($lexer->isCurrent(Lexer::T_SELECT)):
                $this->getParser('select')->parse($lexer);
                break;
            case ($lexer->isCurrent(Lexer::T_UPDATE)):
                break;
            case ($lexer->isCurrent(Lexer::T_DELETE)):
                break;
            default:
                throw new SyntaxErrorException(sprintf('Syntax error. Expected either SELECT, UPDATE or DELETE got "%s" at position %d',
                    $lexer->getTokenValue(), $lexer->getTokenPosition()));
        }
        
        return;
    }
    
    
    
    /**
     * @return LexerInterface
     */
    public function getLexer()
    {
        return $this->lexer;
    }
    
    /**
     * @return PlatformInterface
     */
    public function getPlatform()
    {
        return $this->platform;
    }
    
    /**
     * @return CollectionInterface|ParserInterface[]
     */
    public function getParsers()
    {
        return $this->parsers;
    }
    
   
    
}