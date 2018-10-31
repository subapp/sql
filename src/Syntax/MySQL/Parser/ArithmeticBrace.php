<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class ArithmeticBrace
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class ArithmeticBrace extends Arithmetic
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|ArithmeticExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $expression = parent::parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        
        return $expression;
    }
}