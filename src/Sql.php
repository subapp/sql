<?php

namespace Subapp\Sql;

use Subapp\Cache\Adapter\ArrayAdapter;
use Subapp\Cache\Pool\CacheItemPool;
use Subapp\Cache\Serializer\JsonSerializer;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Node;
use Subapp\Sql\Query\QueryBuilder;
use Subapp\Sql\Query\Recognizer;
use Subapp\Sql\Converter\Provider;
use Subapp\Sql\Converter\ProviderInterface;
use Subapp\Sql\Syntax\CacheProcessor;
use Subapp\Sql\Syntax\Common\DefaultParserSetup;
use Subapp\Sql\Syntax\ParserSetupInterface;
use Subapp\Sql\Syntax\Processor;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Sql
 * @package Subapp\Sql
 */
class Sql
{
    
    /**
     * @var LexerInterface
     */
    private $lexer;
    
    /**
     * @var Recognizer
     */
    private $recognizer;
    
    /**
     * @var ProcessorInterface
     */
    private $processor;
    
    /**
     * @var ProviderInterface
     */
    private $renderer;
    
    /**
     * @var Node
     */
    private $node;
    
    /**
     * Sql constructor.
     */
    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->processor = new Processor($this->lexer);
        $this->renderer = new Provider();
        $this->recognizer = new Recognizer($this->processor);
        $this->node = new Node($this->recognizer);
    }

    /**
     * @param ParserSetupInterface|null $setup
     * @return ProcessorInterface
     */
    public function createParserProcessor(ParserSetupInterface $setup = null)
    {
        $processor = clone($this->processor);

        $processor->cleanParsers();
        $processor->setup($setup ?? new DefaultParserSetup());

        return $processor;
    }

    /**
     * @param ParserSetupInterface|null $setup
     * @return CacheProcessor|ProcessorInterface
     */
    public function createCacheParserProcessor(ParserSetupInterface $setup = null)
    {
        $processor = new CacheProcessor(new CacheItemPool(
            new ArrayAdapter(new JsonSerializer())
        ), $this->getProcessor());

        $processor->cleanParsers();
        $processor->setup($setup ?? new DefaultParserSetup());

        return $processor;
    }
    
    /**
     * @return LexerInterface
     */
    public function getLexer(): LexerInterface
    {
        return $this->lexer;
    }
    
    /**
     * @param LexerInterface $lexer
     */
    public function setLexer(LexerInterface $lexer): void
    {
        $this->lexer = $lexer;
    }
    
    /**
     * @return Recognizer
     */
    public function getRecognizer(): Recognizer
    {
        return $this->recognizer;
    }
    
    /**
     * @param Recognizer $recognizer
     */
    public function setRecognizer(Recognizer $recognizer): void
    {
        $this->recognizer = $recognizer;
    }
    
    /**
     * @return ProcessorInterface
     */
    public function getProcessor(): ProcessorInterface
    {
        return $this->processor;
    }
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setProcessor(ProcessorInterface $processor): void
    {
        $this->processor = $processor;
    }
    
    /**
     * @return ProviderInterface
     */
    public function getRenderer(): ProviderInterface
    {
        return $this->renderer;
    }
    
    /**
     * @param ProviderInterface $renderer
     */
    public function setRenderer(ProviderInterface $renderer): void
    {
        $this->renderer = $renderer;
    }
    
    /**
     * @return Node
     */
    public function getNode(): Node
    {
        return $this->node;
    }
    
    /**
     * @param Node $node
     */
    public function setNode(Node $node): void
    {
        $this->node = $node;
    }
    
}