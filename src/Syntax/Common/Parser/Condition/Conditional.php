<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\AbstractPredicate;
use Subapp\Sql\Ast\Condition\Conditions;
use Subapp\Sql\Ast\Condition\LogicOperator;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Conditional
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Conditional extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return Conditions|AbstractPredicate
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->and($processor);
    }

    /**
     * @param ProcessorInterface $processor
     * @return Conditions|AbstractPredicate
     */
    public function recognize(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $uncover = $this->getUncoverParser($processor);

        // information about ahead expression
        $isOpenBrace = $this->isOpenBrace($lexer);
        $isInsideNestedBraces = $isOpenBrace && $this->isTokenBehindBraces($lexer, true, Lexer::T_CLOSE_BRACE);
        $isComparisonBehindBraces = $isOpenBrace && $this->isTokenBehindBraces($lexer, true, ...static::CMP_TOKENS);
        $isLogicalBehindBraces = $isOpenBrace && $this->isTokenBehindBraces($lexer, true, ...static::LOGICAL_TOKENS);
        $isMathBehindBraces = $isOpenBrace && $this->isTokenBehindBraces($lexer, true, ...static::MATH_TOKENS);

        // complex boolean values
        $perhapsEndOfCondition = (!$isComparisonBehindBraces && !$isMathBehindBraces && $isOpenBrace);
        $ifNeedOnUncovering = ($perhapsEndOfCondition || $isLogicalBehindBraces || $isInsideNestedBraces);

        /** @var Conditions|AbstractPredicate $expression */
        $expression = null;

        switch (true) {
            /**
             * @todo for ugly and difficult conditional expressions
             * if expression in nested braces
             * @example: ((((a > 1))) and b > 10) or (a > 1 and ...) or (a + 1 > 1 and ...)
             */
            case $ifNeedOnUncovering:
                $expression = $uncover->uncover($this, $processor);
                break;
            default:
                $expression = $this->predicate($processor);
        }

        return $expression;
    }

    /**
     * @param ProcessorInterface $processor
     * @return AbstractPredicate|Conditions
     */
    public function and(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $collection = new Conditions();
        
        $collection->setOperator(LogicOperator::AND);

        do {
            $collection->append($this->or($processor));
        } while ($lexer->toToken(Lexer::T_AND));

        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection->offsetExists(1) ? $collection : $collection->offsetGet(0);
    }

    /**
     * @param ProcessorInterface $processor
     * @return AbstractPredicate|Conditions
     */
    public function or(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $collection = new Conditions();

        $collection->setOperator(LogicOperator::OR);
        
        do {
            $collection->append($this->xor($processor));
        } while ($lexer->toToken(Lexer::T_OR));

        $collection->setIsBraced(true);

        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection->offsetExists(1) ? $collection : $collection->offsetGet(0);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return AbstractPredicate|Conditions
     */
    public function xor(ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $collection = new Conditions();
        
        $collection->setOperator(LogicOperator::XOR);
        
        do {
            $collection->append($this->recognize($processor));
        } while ($lexer->toToken(Lexer::T_XOR));
        
        $collection->setIsBraced(true);
        
        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection->offsetExists(1) ? $collection : $collection->offsetGet(0);
    }
    
    /**
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function predicate(ProcessorInterface $processor)
    {
        $predicate = $this->getPredicateParser($processor);
        $expression = $predicate->parse($processor->getLexer(), $processor);

        return $expression;
    }

}