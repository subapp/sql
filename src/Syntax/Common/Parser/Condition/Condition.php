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
    
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->and($processor);
    }
    
    public function recognize(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        
        $isOpenBrace = $this->isOpenBrace($lexer);
        $isLogical = $this->isLogicalExpression($lexer);
        $isComparison = $this->isComparisonExpression($lexer);
        $isMath = $this->isMathExpression($lexer);
        
        var_dump([
            $isOpenBrace,
            $isLogical,
            $isComparison,
            $isMath,
        ]);
        
        $uncover = $this->getUncoverParser($processor);
        
        $expression = null;
        
        switch (true) {
            case ($isOpenBrace && ($isLogical || $isComparison || $isMath)):
                // uncover braces and run $this->parse();
                $expression = $uncover->uncover($this, $processor);
                break;
            case (!$isOpenBrace && ($isComparison || $isMath)):
                $expression = $this->comparison($processor);
                break;
            default:
                $this->throwSyntaxError($lexer,
                    'OpenBrace', 'MathExpression', 'ComparisonExpression', 'LogicalExpression');
        }
        
        return $expression;
    }
    
    public function and(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $collection = new Conditions();
        $operator = $this->getLogicOperatorParser($processor);
        
        do {
            /** @var Term $expression */
            $expression = $this->or($processor);
            
            if ($expression instanceof Conditions) {
                $expression = new Term(null, $expression);
            }
            
            $isOperator = $this->isLogicAnd($lexer);
            
            if ($isOperator) {
                $expression->setOperator($operator->parse($lexer, $processor));
            }
            
            $collection->append($expression);
        } while ($isOperator);
        
        return $collection;
    }
    
    public function or(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $collection = new Conditions();
        $operator = $this->getLogicOperatorParser($processor);
        
        do {
            $expression = $this->term($processor);
            $isOperator = $this->isLogicOr($lexer) || $this->isLogicXor($lexer);
            
            if ($isOperator) {
                $expression->setOperator($operator->parse($lexer, $processor));
            }
            
            $collection->append($expression);
        } while ($isOperator);
        
        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection->offsetExists(1) ? $collection : $collection->offsetGet(0);
    }
    
    public function term(ProcessorInterface $processor)
    {
        return new Term(null, $this->recognize($processor));
    }
    
    public function comparison(ProcessorInterface $processor)
    {
        $comparison = $this->getComparisonParser($processor);
        $expression = $comparison->parse($processor->getLexer(), $processor);
        
        return $expression;
    }
    
}