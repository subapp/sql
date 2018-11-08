<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\Operator as CmpOperatorExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class CmpOperator
 * @package Subapp\Sql\Syntax\Common\Parser\Condition
 */
class CmpOperator extends AbstractDefaultParser
{
    
    const MAP = [
        Lexer::T_EQ => CmpOperatorExpression::EQ,
        Lexer::T_NE => CmpOperatorExpression::NE,
        Lexer::T_GT => CmpOperatorExpression::GT,
        Lexer::T_GE => CmpOperatorExpression::GE,
        Lexer::T_LT => CmpOperatorExpression::LT,
        Lexer::T_LE => CmpOperatorExpression::LE,
    ];
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return CmpOperatorExpression|ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $token = $lexer->getNext();
        $operator = isset(CmpOperator::MAP[$token->getType()]) ? CmpOperator::MAP[$token->getType()] : null;
        
        if (null === $operator) {
            $this->throwSyntaxError($lexer, ...array_keys(CmpOperator::MAP));
        }
        
        $lexer->next();
        
        return new CmpOperatorExpression($operator);
    }
    
}