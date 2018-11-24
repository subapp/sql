<?php

namespace Subapp\Sql;

use Subapp\Cache\Adapter\ArrayAdapter;
use Subapp\Cache\Pool\CacheItemPool;
use Subapp\Cache\Serializer\JsonSerializer;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Converter\DefaultProviderSetup;
use Subapp\Sql\Converter\ProviderInterface;
use Subapp\Sql\Dumper\DumperFacade;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Node;
use Subapp\Sql\Query\Recognizer;
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
    private $converter;
    
    /**
     * @var Node
     */
    private $node;
    
    /**
     * @var DumperFacade
     */
    private $dumper;
    
    /**
     * Sql constructor.
     */
    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->processor = new Processor($this->lexer);
        $this->converter = new Converter();
        $this->recognizer = new Recognizer($this->processor);
        $this->node = new Node($this->recognizer);
        $this->dumper = new DumperFacade();
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
     * @param $string
     * @return Ast\NodeInterface
     */
    public function createAstFromString($string)
    {
        $processor = $this->createParserProcessor();
        $processor->getLexer()->tokenize($string);
        
        return $processor->parse();
    }
    
    public function createAstFromArray(array $ast)
    {
        return $this->converter->toNode($ast);
    }
    
    
    public function convertSqlToArray($sql)
    {
        $ast = $this->createAstFromString($sql);
        
        $this->converter->setup(new DefaultProviderSetup());
        
        return $this->converter->toArray($ast);
    }
    
    /**
     * @param string $sql
     * @return false|string
     */
    public function convertSqlToJson($sql)
    {
        return $this->dumper->getJsonDumper()->dump($this->convertSqlToArray($sql));
    }
    
    /**
     * @param string $sql
     * @return false|string
     */
    public function convertSqlToIni($sql)
    {
        return $this->dumper->getIniDumper()->dump($this->convertSqlToArray($sql));
    }
    
    /**
     * @param string $sql
     * @return false|string
     */
    public function convertSqlToYaml($sql)
    {
        return $this->dumper->getYamlDumper()->dump($this->convertSqlToArray($sql));
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
    public function getConverter(): ProviderInterface
    {
        return $this->converter;
    }
    
    /**
     * @param ProviderInterface $converter
     */
    public function setConverter(ProviderInterface $converter): void
    {
        $this->converter = $converter;
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