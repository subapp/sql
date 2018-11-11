<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Term;
use Subapp\Sql\Ast\Condition\Conditions;
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
     * @return ExpressionInterface|Conditions
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $collection = new Conditions();
        $parser = $this->getLogicOperatorParser($processor);

        do {
            
            $element = new Term();
            $expression = $this->parseComparisonTerm($lexer, $processor);
            $element->setExpression($expression);
            
            $collection->append($element);
            
            $satisfied = $lexer->isNextAny([Lexer::T_OR, Lexer::T_XOR,]);
            
            if ($satisfied) {
                $element->setOperator($parser->parse($lexer, $processor));
            }
            
        } while ($satisfied);
        
        return $collection;
    }
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return Conditions
     */
    public function parseComparisonTerm(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $conditions = new Conditions();
        $comparison = $this->getComparisonParser($processor);
        $logical = $this->getLogicOperatorParser($processor);
        
        do {
            
            $isNotMathExpression = $this->isBraced($lexer);
    
            if ($isNotMathExpression) {
                
                $lexer->setPeek(1);
            
                // @todo dirty hack for expression below
                // (t0.cnt / 10 - 3) = sum(distinct u.cnt) || round(pi(), 2) = 3.14
                
                switch (true) {
                    case $this->isFieldPath($lexer):
                        $lexer->setPeek(4);
                        $isNotMathExpression = !$this->isMathOperator($lexer);
                        break;
                    case $this->isLiteral($lexer):
                        $lexer->setPeek(2);
                        $isNotMathExpression = !$this->isMathOperator($lexer);
                        break;
                }
            }
            
            $isNotMathExpression = $isNotMathExpression && !$this->isMathOperator($lexer);

            if ($isNotMathExpression) {
                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $expression = $this->parse($lexer, $processor);
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
            } else {
                $expression = $comparison->parse($lexer, $processor);
            }
            
            $element = new Term(null, $expression);
            $conditions->append($element);
            
            
            // need in loop
            $satisfied = $lexer->isNextAny([Lexer::T_AND]);
            
            if ($satisfied) {
                $element->setOperator($logical->parse($lexer, $processor));
            }
            
        } while ($satisfied);
        
        return $conditions;
    }
    
}