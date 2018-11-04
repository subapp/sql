<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Operand as OperandExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Operand
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Operand extends AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|OperandExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->parseFactor($lexer, $processor);
    }

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\Embrace|OperandExpression
     */
    public function parseFactor(LexerInterface $lexer, ProcessorInterface $processor)
    {

        if ($this->isFactorMathOperator($lexer)) {
            $factor = new \Subapp\Sql\Ast\Arithmetic();

            while ($this->isFactorMathOperator($lexer)) {
                $this->shiftAnyIf($lexer, [Lexer::T_MULTIPLY, Lexer::T_DIVIDE]);
                $expression = $this->parsePlain($lexer, $processor);
                $factor->addOperand($expression);
            };

            return new OperandExpression('-', new \Subapp\Sql\Ast\Embrace($factor));
        } else {
            return $this->parsePlain($lexer, $processor);
        }
    }

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return OperandExpression
     */
    public function parsePlain(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $operator = OperandExpression::NONE;

        if ($this->isMathOperator($lexer)) {
            $this->shiftAnyIf($lexer, [Lexer::T_PLUS, Lexer::T_MINUS,]);
            $operator = $lexer->getTokenValue();
        }

        return new OperandExpression($operator, $this->getExpressionParser($processor)->parse($lexer, $processor));
    }
    
}