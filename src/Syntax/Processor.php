<?php

namespace Subapp\Sql\Syntax;

use Subapp\Collection\Collection;
use Subapp\Collection\CollectionInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Exception\SyntaxErrorException;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Platform\PlatformInterface;

/**
 * Class ParserProcessor
 * @package Subapp\Sql
 */
final class Processor implements ProcessorInterface
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
     * @var ParserHelper
     */
    private $helper;
    
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
        $this->helper = new ParserHelper();
    }
    
    /**
     * @inheritdoc
     */
    public function setup(ParserSetupInterface $parserSetup)
    {
        $parserSetup->setup($this);
    }
    
    /**
     * @inheritdoc
     */
    public function addParser(ParserInterface $parser)
    {
        $this->parsers->offsetSet($parser->getName(), $parser);
    }
    
    /**
     * @inheritdoc
     */
    public function removeParser($name)
    {
        $this->parsers->remove($name);
    }
    
    /**
     * @inheritdoc
     */
    public function hasParser($name)
    {
        return $this->parsers->offsetExists($name);
    }
    
    /**
     * @inheritdoc
     */
    public function getParser($name)
    {
        $parser = $this->parsers->offsetGet($name);
        
        if (!($parser instanceof ParserInterface)) {
            throw new \RuntimeException(sprintf('Unfortunately parser with name "%s" doesn\'t registered yet',
                $name));
        }
        
        return $parser;
    }
    
    /**
     * @inheritdoc
     */
    public function cleanParsers()
    {
        $this->parsers->clear();
    }
    
    /**
     * @inheritdoc
     */
    public function parse()
    {
        $lexer = $this->getLexer();
        
        // reset lexer to start
        $lexer->rewind();
        
        // statement name
        $name = null;
        
        // determine which of statement will be parsed
        switch (true) {
            case ($lexer->isCurrent(Lexer::T_SELECT)):
                $name = 'select'; break;
            case ($lexer->isCurrent(Lexer::T_UPDATE)):
                $name = 'update'; break;
            case ($lexer->isCurrent(Lexer::T_DELETE)):
                $name = 'delete'; break;
            default:
                $this->helper->throwSyntaxError($lexer, null, Lexer::T_SELECT, Lexer::T_UPDATE, Lexer::T_DELETE);
        }
    
        return $this->getParser("stmt.{$name}_statement")->parse($lexer, $this);
    }
    
    /**
     * @inheritdoc
     */
    public function getLexer()
    {
        return $this->lexer;
    }
    
    /**
     * @inheritdoc
     */
    public function setLexer(LexerInterface $lexer)
    {
        $this->lexer = $lexer;
    }
    
    /**
     * @inheritdoc
     */
    public function getPlatform()
    {
        return $this->platform;
    }
    
    /**
     * @inheritdoc
     */
    public function getParsers()
    {
        return $this->parsers;
    }
    
}