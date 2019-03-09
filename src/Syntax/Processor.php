<?php

namespace Subapp\Sql\Syntax;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Common\Collection;
use Subapp\Sql\Context;
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
     * @var Collection|ParserInterface[]
     */
    private $parsers;
    
    /**
     * @var ParserHelper
     */
    private $helper;
    
    /**
     * @var Context
     */
    private $context;
    
    /**
     * Query constructor.
     * @param LexerInterface $lexer
     */
    public function __construct(LexerInterface $lexer)
    {
        $this->context = new Context();
        $this->parsers = new Collection();
        $this->lexer = $lexer;
        $this->helper = new ParserHelper();
        
        $this->parsers->setClass(ParserInterface::class);
    }
    
    /**
     * @inheritdoc
     */
    public function setup(ProcessorSetupInterface $parserSetup)
    {
        $parserSetup->setup($this);
    }
    
    /**
     * @inheritdoc
     */
    public function add(ParserInterface $parser)
    {
        $this->parsers->offsetSet($parser->getName(), $parser);
    }
    
    /**
     * @inheritdoc
     */
    public function remove($name)
    {
        $this->parsers->remove($name);
    }
    
    /**
     * @inheritdoc
     */
    public function has($name)
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
    public function clean()
    {
        $this->parsers->clear();
    }
    
    /**
     * @inheritdoc
     */
    public function parse()
    {
        $lexer = $this->getLexer();
        
        // check if Lexer ready to work
        if ($lexer->getTokens() == 0) {
            throw new \RuntimeException('Nothing to parse. Lexer is not tokenized yet');
        }
        
        // reset lexer to start
        $lexer->rewind();
        
        // statement name
        $name = null;
        
        // determine which of statement will be parsed
        switch (true) {
            case ($lexer->isCurrent(Lexer::T_SELECT)):
                $name = ParserInterface::PARSER_STMT_SELECT;
                break;
            case ($lexer->isCurrent(Lexer::T_UPDATE)):
                $name = ParserInterface::PARSER_STMT_UPDATE;
                break;
            case ($lexer->isCurrent(Lexer::T_DELETE)):
                $name = ParserInterface::PARSER_STMT_DELETE;
                break;
            case ($lexer->isCurrent(Lexer::T_INSERT)):
                $name = ParserInterface::PARSER_STMT_INSERT;
                break;
            default:
                $this->helper->throwSyntaxError($lexer, null, Lexer::T_SELECT, Lexer::T_UPDATE, Lexer::T_DELETE, Lexer::T_INSERT);
        }
        
        return $this->getParser($name)->parse($lexer, $this);
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
    
    /**
     * @inheritdoc
     */
    public function getContext()
    {
        return $this->context;
    }
    
}