<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Collection;
use Subapp\Sql\Ast\Embrace;
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
     * @return ExpressionInterface|Collection
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new Collection();
        $logical = $this->getLogicOperatorParser($processor);
        
        do {
            $collection->append(new Embrace($this->parseComparisonTerm($lexer, $processor)));
    
            $isLogicalOperator = $lexer->isNextAny([Lexer::T_OR, Lexer::T_XOR,]);
    
            if ($isLogicalOperator) {
                $collection->append($logical->parse($lexer, $processor));
            }
            
        } while ($isLogicalOperator);
        
        return $collection;
    }
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return Collection
     */
    public function parseComparisonTerm(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new Collection();
        $comparison = $this->getComparisonParser($processor);
        $logical = $this->getLogicOperatorParser($processor);
        
        do {
            if ($this->isBraced($lexer)) {
                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $expression = $this->parse($lexer, $processor);
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
            } else {
                $expression = $comparison->parse($lexer, $processor);
            }
            
            $collection->append($expression);
            
            $isNext = $lexer->isNextAny([Lexer::T_AND]);
    
            if ($isNext) {
                $collection->append($logical->parse($lexer, $processor));
            }
        } while ($isNext);
        
        return $collection;
    }
    
}