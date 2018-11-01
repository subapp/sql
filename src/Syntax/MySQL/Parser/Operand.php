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
        $parser = $this->getExpressionParser($processor);
        $expression = null;
        $operator = OperandExpression::NONE;

        if ($this->isMathOperator($lexer)) {
            $this->shiftAny($lexer, [Lexer::T_PLUS, Lexer::T_MINUS, Lexer::T_MULTIPLY, Lexer::T_DIVIDE]);
            $operator = $lexer->getToken()->getToken();
        }

        $expression = $parser->parse($lexer, $processor);
    
        return new OperandExpression($operator, $expression);
    }
    
}