<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
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
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $expression = null;

        // sequence of cases is important
        switch (true) {
            case $this->isLiteral($lexer):
                $expression = $this->getLiteralParser($processor)->parse($lexer, $processor);
                break;
            case $this->isFunction($lexer):
                $expression = $this->getSimpleFuncParser($processor)->parse($lexer, $processor);
                break;
            case $this->isMathExpression($lexer):
                die($this->getStringToToken($lexer, Lexer::T_COMMA));
//                $expression = $this->getArithmeticParser($processor)->parse($lexer, $processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Function', 'MathExpression', 'Literal');
        }
        
        return $expression;
    }
    
}