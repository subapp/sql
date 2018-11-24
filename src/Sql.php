<?php

namespace Subapp\Sql;

use Psr\Cache\CacheItemPoolInterface;
use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Converter\DefaultConverterSetup;
use Subapp\Sql\Converter\ProviderInterface;
use Subapp\Sql\Dumper\DumperFacade;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\CacheProcessor;
use Subapp\Sql\Syntax\Common\DefaultProcessorSetup;
use Subapp\Sql\Syntax\ProcessorSetupInterface;
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
     * @var ProviderInterface
     */
    private $converter;
    
    /**
     * @var DumperFacade
     */
    private $dumper;
    
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;
    
    /**
     * Sql constructor.
     */
    public function __construct()
    {
        $this->lexer = new Lexer();
        $this->dumper = new DumperFacade();
        $this->converter = new Converter();
        $this->converter->setup(new DefaultConverterSetup());
    }
    
    /**
     * @param ProcessorSetupInterface|null $setup
     * @return ProcessorInterface
     */
    public function createParser(ProcessorSetupInterface $setup = null)
    {
        $processor = new Processor($this->getLexer());
        
        $processor->clean();
        $processor->setup($setup ?: new DefaultProcessorSetup());
        
        return $processor;
    }
    
    /**
     * @param ProcessorSetupInterface|null $setup
     * @return CacheProcessor|ProcessorInterface
     */
    public function createCacheParser(ProcessorSetupInterface $setup = null)
    {
        return new CacheProcessor($this->getCache(), $this->createParser($setup));
    }
    
    /**
     * @param $string
     * @return Ast\NodeInterface
     */
    public function createAstFromString($string)
    {
        $processor = $this->createParser(null);
        $lexer = $processor->getLexer();
        
        $lexer->tokenize($string);
        
        return $processor->parse();
    }
    
    public function createAstFromArray(array $ast)
    {
        return $this->converter->toNode($ast);
    }
    
    
    public function convertSqlToArray($sql)
    {
        return $this->getConverter()->toArray($this->createAstFromString($sql));
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
     * @return CacheItemPoolInterface
     */
    public function getCache(): CacheItemPoolInterface
    {
        return $this->cache;
    }
    
    /**
     * @param CacheItemPoolInterface $cache
     */
    public function setCache(CacheItemPoolInterface $cache): void
    {
        $this->cache = $cache;
    }
    
    /**
     * @return DumperFacade
     */
    public function getDumper(): DumperFacade
    {
        return $this->dumper;
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
    
}