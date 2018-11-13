<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Term;
use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\Common\Parser\Uncover;
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
            
            $hasOperator = $lexer->isNextAny([Lexer::T_OR, Lexer::T_XOR,]);
            
            if ($hasOperator) {
                $element->setOperator($parser->parse($lexer, $processor));
            }
            
        } while ($hasOperator);
        
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
        $uncover = $this->getUncoverParser($processor);
        $comparison = $this->getComparisonParser($processor);
        $logical = $this->getLogicOperatorParser($processor);

        $operators = [
            Lexer::T_EQ, Lexer::T_NE, Lexer::T_GT, Lexer::T_GE, Lexer::T_LT, Lexer::T_LE, // primary
            Lexer::T_NOT, Lexer::T_BETWEEN, Lexer::T_IN, Lexer::T_IS, Lexer::T_LIKE, // special
        ];
        
        do {
            
            $difficultExpression = $this->isPeekAgainst($lexer, $operators, [Lexer::T_CLOSE_BRACE]);
            $isNotMathExpression = $this->isNotMathExpression($lexer);
            $isJustBrace = ($isNotMathExpression or $difficultExpression);

//            if ($this->isOpenBrace($lexer) && $isJustBrace) {
//                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
//                $expression = $this->parse($lexer, $processor);
//                $expression = $uncover->uncoverWith($comparison, $processor);

//                var_dump($expression);

//                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
//            } else {
//
                $expression = $comparison->parse($lexer, $processor);
//            }
            
            $element = new Term(null, $expression);
            $conditions->append($element);
            
            // need in loop
            $hasOperator = $lexer->isNextAny([Lexer::T_AND]);
            
            if ($hasOperator) {
                $element->setOperator($logical->parse($lexer, $processor));
            }
            
        } while ($hasOperator);
        
        return $conditions;
    }
    
}