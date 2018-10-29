<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arithmetic as ArithmeticExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Arithmetic
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Arithmetic extends AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ArithmeticExpression|ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = $this->getMathOperandParser($processor);
        
        $arithmetic = new ArithmeticExpression();
        
        $operandA = $parser->parse($lexer, $processor);
        
        if (null === $operandA) {
            die($this->getStringToToken($lexer, Lexer::T_COMMA));
        }
        
        $arithmetic->setOperandA($operandA);
        
        if (!$this->isMathOperator($lexer)) {
            $this->throwSyntaxError($lexer, '+', '-', '/', '*');
        }
    
        $lexer->next();
        $token = $lexer->getToken();
        
        $arithmetic->setOperator($token->getToken());
        $arithmetic->setOperandB($parser->parse($lexer, $processor));
        
        return $arithmetic;
    }
    
}