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
    
    const COMMON     = ParserInterface::PARSER_A;
    const EXPRESSION = ParserInterface::PARSER_C;
    const PRIMARY    = ParserInterface::PARSER_D;
    
    /**
     * @var ProcessorInterface
     */
    private $processor;
    
    /**
     * @var string
     */
    private $complexity;
    
    /**
     * Recognizer constructor.
     * @param ProcessorInterface $processor
     * @param string             $complexity
     */
    public function __construct(ProcessorInterface $processor, $complexity = Recognizer::EXPRESSION)
    {
        $this->processor = $processor;
        $this->complexity = $complexity;
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
        return $this->processor->getParser($this->complexity);
    }
    
    /**
     * @return string
     */
    public function getComplexity()
    {
        return $this->complexity;
    }
    
    /**
     * @param string $complexity
     */
    public function setComplexity($complexity)
    {
        $this->complexity = $complexity;
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