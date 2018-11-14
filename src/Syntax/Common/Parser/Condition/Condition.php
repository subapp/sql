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
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return mixed|null|Conditions|ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->and($processor);
    }

    /**
     * @param ProcessorInterface $processor
     * @return null|ExpressionInterface
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


        $expression = null;

        switch (true) {
            /**
             * if expression in nested braces
             * @example: ((((a > 1))) and b > 10) or (a > 1 and ...) or (a + 1 > 1 and ...)
             */
            case $ifNeedOnUncovering:
                $expression = $uncover->uncover($this, $processor);
                break;
            default:
                $expression = $this->comparison($processor);
        }

        return $expression;
    }

    /**
     * @param ProcessorInterface $processor
     * @return Term|Conditions
     */
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

        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection;
    }

    /**
     * @param ProcessorInterface $processor
     * @return Term|Conditions
     */
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

        $collection->setIsBraced(true);

        // if just one expression was reached then return just it, otherwise conditions (collection)
        return $collection->offsetExists(1) ? $collection : $collection->offsetGet(0);
    }

    /**
     * @param ProcessorInterface $processor
     * @return Term
     */
    public function term(ProcessorInterface $processor)
    {
        return new Term(null, $this->recognize($processor));
    }

    /**
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function comparison(ProcessorInterface $processor)
    {
        $comparison = $this->getComparisonParser($processor);
        $expression = $comparison->parse($processor->getLexer(), $processor);

        return $expression;
    }

}