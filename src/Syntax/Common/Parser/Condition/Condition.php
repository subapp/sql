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
    
        $operators = [Lexer::T_EQ, Lexer::T_NE, Lexer::T_GT, Lexer::T_GE, Lexer::T_LT, Lexer::T_LE, Lexer::T_NOT, Lexer::T_BETWEEN, Lexer::T_IN, Lexer::T_IS, Lexer::T_LIKE,];
        
        do {
            
            $difficultExpression = $this->isPeekAgainst($lexer, $operators, [Lexer::T_CLOSE_BRACE]);
            $isJustBrace = ($this->isNotMathExpression($lexer) || $difficultExpression);
            
            if ($this->isOpenBrace($lexer) && $isJustBrace) {
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