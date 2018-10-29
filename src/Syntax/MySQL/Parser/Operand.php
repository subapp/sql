<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
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
        
        switch (true) {
            case $this->isFunction($lexer):
                $expression = $this->getOrdinaryFunctionParser($processor)->parse($lexer, $processor);
                break;
//            case $this->isMathExpression($lexer):
//                $expression = $this->getArithmeticParser($processor)->parse($lexer, $processor);
//                break;
            case $this->isLiteral($lexer):
                $expression = $this->getLiteralParser($processor)->parse($lexer, $processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Function', 'MathExpression', 'Literal');
        }
        
        return $expression;
    }
    
}