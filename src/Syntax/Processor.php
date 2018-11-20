<?php

namespace Subapp\Sql\Syntax;

use Subapp\Sql\Common\Collection;
use Subapp\Sql\Common\CollectionInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;

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
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->parsers = new Collection();
        $this->lexer = $lexer;
        $this->helper = new ParserHelper();
    
        $this->parsers->setClass(ParserInterface::class);
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
    
        return $this->getParser("stmt.{$name}")->parse($lexer, $this);
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
    public function getParsers()
    {
        return $this->parsers;
    }
    
}