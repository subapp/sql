<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Term;
use Subapp\Sql\Ast\Condition\TermCollection;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Condition
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Condition extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|TermCollection
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new TermCollection();
        $parser = $this->getLogicOperatorParser($processor);
        
        do {
            $term = new Term();
            $expression = $this->parseComparisonTerm($lexer, $processor);
            
            $term->setExpression($expression);
            
            $collection->append($term);
    
            $isLogicalOperator = $lexer->isNextAny([Lexer::T_OR, Lexer::T_XOR,]);
    
            if ($isLogicalOperator) {
                $term->setOperator($parser->parse($lexer, $processor));
            }
        } while ($isLogicalOperator);
    
        return $collection;
    }
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return TermCollection
     */
    public function parseComparisonTerm(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new TermCollection();
        $comparison = $this->getComparisonParser($processor);
        $logical = $this->getLogicOperatorParser($processor);
        
        do {
            $term = new Term();
            
            if ($this->isBraced($lexer)) {
                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $expression = $this->parse($lexer, $processor);
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
            } else {
                $expression = $comparison->parse($lexer, $processor);
            }
    
            $term->setExpression($expression);
            
            $collection->append($term);
            
            $isNext = $lexer->isNextAny([Lexer::T_AND]);
    
            if ($isNext) {
                $term->setOperator($logical->parse($lexer, $processor));
            }
        } while ($isNext);
        
        return $collection;
    }
    
}