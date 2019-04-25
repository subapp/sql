<?php

namespace Subapp\Sql;

use Subapp\Collection\Collection;
use Subapp\Sql\Converter\Converter;
use Subapp\Sql\Converter\DefaultConverterSetup;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Query\Builder;
use Subapp\Sql\Query\Query;
use Subapp\Sql\Query\Recognizer;
use Subapp\Sql\Syntax\Common\DefaultProcessorSetup;
use Subapp\Sql\Syntax\Extra\ExtraProcessorSetup;
use Subapp\Sql\Syntax\Processor;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Factory
 * @package Subapp\Sql
 */
class Sql
{
    
    private const PROCESSOR = 1;
    private const CONVERTER = 2;
    private const CONTEXT = 3;
    
    /**
     * @var Sql
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
            Sql::PROCESSOR  => $this->newProcessor(),
            Sql::CONVERTER  => $this->newConverter(),
            Sql::CONTEXT    => $this->newContext(),
        ]);
    }
    
    /**
     * @return Context
     */
    public function getContext()
    {
        return $this->collection->get(Sql::CONTEXT);
    }
    
    /**
     * @return Context
     */
    public function newContext()
    {
        return new Context();
    }
    
    /**
     * @return ProcessorInterface
     */
    public function getProcessor()
    {
        return $this->collection->get(Sql::PROCESSOR);
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
     * @return Converter
     */
    public function getConverter()
    {
        return $this->collection->get(Sql::CONVERTER);
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
     * @return Builder
     */
    public function newBuilder() {
        $node = new Builder();
    
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
     * @return Query
     */
    public function newQuery()
    {
        $query = new Query($this->newBuilder());
        
        $query->setConverter($this->getConverter());
        
        return $query;
    }
    
    /**
     * @return Sql
     */
    public static function getInstance() {
        $isNull = Sql::$instance == null;
        
        if ($isNull) {
            Sql::$instance = new Sql();
        }
        
        return Sql::$instance;
    }
    
}
