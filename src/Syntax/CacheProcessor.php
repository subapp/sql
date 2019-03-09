<?php

namespace Subapp\Sql\Syntax;

use Psr\Cache\CacheItemPoolInterface;
use Subapp\Lexer\LexerInterface;

/**
 * Class CacheProcessor
 * @package Subapp\Sql\Syntax
 */
class CacheProcessor implements ProcessorInterface
{
    
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;
    
    /**
     * @var ProcessorInterface
     */
    private $processor;
    
    /**
     * CachedProcessor constructor.
     * @param CacheItemPoolInterface $cache
     * @param ProcessorInterface     $processor
     */
    public function __construct(CacheItemPoolInterface $cache, ProcessorInterface $processor)
    {
        $this->cache = $cache;
        $this->processor = $processor;
    }
    
    /**
     * @inheritDoc
     */
    public function setup(ProcessorSetupInterface $parserSetup)
    {
        $this->processor->setup($parserSetup);
    }
    
    /**
     * @inheritDoc
     */
    public function add(ParserInterface $parser)
    {
        $this->processor->add($parser);
    }
    
    /**
     * @inheritDoc
     */
    public function remove($name)
    {
        $this->processor->remove($name);
    }
    
    /**
     * @inheritDoc
     */
    public function has($name)
    {
        return $this->processor->has($name);
    }
    
    /**
     * @inheritDoc
     */
    public function clean()
    {
        $this->processor->clean();
    }
    
    /**
     * @inheritDoc
     */
    public function getParser($name)
    {
        return $this->processor->getParser($name);
    }
    
    /**
     * @inheritDoc
     */
    public function parse()
    {
        $hash = $this->getLexerHash($this->processor->getLexer());
        $item = $this->cache->getItem($hash);
        
        if (!$item->isHit()) {
            $item->set($this->processor->parse());
            $item->expiresAfter(3600);
            $this->cache->save($item);
        }
        
        return $item->get();
    }
    
    /**
     * @param LexerInterface $lexer
     * @return string
     */
    private function getLexerHash(LexerInterface $lexer)
    {
        $tokens = [];
        
        foreach ($lexer->getTokens() as $token) {
            $tokens[] = sprintf('[%s]', $token->getToken());
        }
        
        return hash('sha256', implode($tokens));
    }
    
    /**
     * @inheritDoc
     */
    public function getLexer()
    {
        return $this->processor->getLexer();
    }
    
    /**
     * @inheritDoc
     */
    public function getParsers()
    {
        return $this->processor->getParsers();
    }
    
    /**
     * @inheritDoc
     */
    public function setLexer(LexerInterface $lexer)
    {
        $this->processor->setLexer($lexer);
    }
    
    /**
     * @inheritDoc
     */
    public function getContext()
    {
        return $this->processor->getContext();
    }
    
}