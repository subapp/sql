<?php

namespace Subapp\Sql;

use Subapp\Collection\Collection;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Converter\DefaultConverterSetup;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Node;
use Subapp\Sql\Query\QueryBuilder;
use Subapp\Sql\Query\Recognizer;
use Subapp\Sql\Syntax\Common\DefaultProcessorSetup;
use Subapp\Sql\Syntax\Extra\ExtraProcessorSetup;
use Subapp\Sql\Syntax\Processor;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Factory
 * @package Subapp\Sql
 */
class Factory
{
    
    private const PROCESSOR = 1;
    private const CONVERTER = 2;
    
    /**
     * @var Factory
     */
    private static $instance;
    
    /**
     * @var Collection
     */
    private $collection;
    
    /**
     * Factory constructor.
     */
    private function __construct()
    {
        $this->collection = new Collection([
            Factory::PROCESSOR => $this->newProcessor(),
            Factory::CONVERTER => $this->newConverter(),
        ]);
    }
    
    /**
     * @return ProcessorInterface
     */
    public function getProcessor()
    {
        return $this->collection->get(Factory::PROCESSOR);
    }
    
    /**
     * @return Processor
     */
    public function newProcessor()
    {
        $lexer = new Lexer();
        
        $processor = new Processor($lexer);
        $processor->setup(new DefaultProcessorSetup());
        $processor->setup(new ExtraProcessorSetup());
        
        return $processor;
    }
    
    /**
     * @return mixed|null
     */
    public function getConverter()
    {
        return $this->collection->get(Factory::CONVERTER);
    }
    
    /**
     * @return Converter
     */
    public function newConverter()
    {
        $converter = new Converter();
        
        $converter->setup(new DefaultConverterSetup());
        
        return $converter;
    }
    
    /**
     * @return Node
     */
    public function newNode() {
        $node = new Node();
    
        $node->setRecognizer($this->newRecognizer());
        
        return $node;
    }
    
    /**
     * @param null|string $complexity
     * @return Recognizer
     */
    public function newRecognizer($complexity = null)
    {
        $recognizer = new Recognizer($this->getProcessor(), $complexity ?? Recognizer::COMMON);
        
        return $recognizer;
    }
    
    /**
     * @return QueryBuilder
     */
    public function newQueryBuilder()
    {
        $queryBuilder = new QueryBuilder($this->newNode());
        
        $queryBuilder->setConverter($this->getConverter());
        
        return $queryBuilder;
    }
    
    /**
     * @return Factory
     */
    public static function getInstance() {
        $isNull = Factory::$instance == null;
        
        if ($isNull) {
            Factory::$instance = new Factory();
        }
        
        return Factory::$instance;
    }
    
}