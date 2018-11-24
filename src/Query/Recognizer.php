<?php

namespace Subapp\Sql\Query;

use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Recognizer
 * @package Subapp\Sql\Query
 */
class Recognizer
{
    
    const COMMON     = ParserInterface::PARSER_COMMON;
    const EXPRESSION = ParserInterface::PARSER_EXPRESSION;
    const PRIMARY    = ParserInterface::PARSER_PRIMARY;
    
    /**
     * @var ProcessorInterface
     */
    private $processor;
    
    /**
     * @var string
     */
    private $rootParser;
    
    /**
     * Recognizer constructor.
     * @param ProcessorInterface $processor
     * @param string             $rootParser
     */
    public function __construct(ProcessorInterface $processor, $rootParser = Recognizer::EXPRESSION)
    {
        $this->processor = $processor;
        $this->rootParser = $rootParser;
    }
    
    /**
     * @return ProcessorInterface
     */
    public function getProcessor()
    {
        return $this->processor;
    }
    
    /**
     * @param ProcessorInterface $processor
     */
    public function setProcessor(ProcessorInterface $processor)
    {
        $this->processor = $processor;
    }
    
    /**
     * @return ParserInterface
     */
    public function getParser()
    {
        return $this->processor->getParser($this->rootParser);
    }
    
    /**
     * @return string
     */
    public function getRootParser()
    {
        return $this->rootParser;
    }
    
    /**
     * @param string $rootParser
     */
    public function setRootParser($rootParser)
    {
        $this->rootParser = $rootParser;
    }
    
    /**
     * @param string $sql
     * @return NodeInterface
     */
    public function recognize($sql)
    {
        $processor = $this->getProcessor();
        $lexer = $processor->getLexer();
        $parser = $this->getParser();
        
        // tokenize parts of SQL:
        // - Count(u.Id) > 4 + 1
        // - u.subscription Not In(1, (SubSelect))
        // - Upper(u.name) UpperName
        // - etc.
        $lexer->tokenize($sql, true);
        
        return $parser->parse($lexer, $processor);
    }
    
}