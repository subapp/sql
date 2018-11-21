<?php

namespace Subapp\Sql\Syntax\Common\Parser\Condition;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Condition\LogicOperator as LogicOperatorExpression;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class LogicOperator
 * @package Subapp\Sql\Syntax\Common\Parser\Condition
 */
class LogicOperator extends AbstractDefaultParser
{
    
    const MAP = [
        Lexer::T_AND => LogicOperatorExpression::AND,
        Lexer::T_OR => LogicOperatorExpression::OR,
        Lexer::T_XOR => LogicOperatorExpression::XOR,
    ];
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|LogicOperatorExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $token = $lexer->getNext();
        $operator = isset(LogicOperator::MAP[$token->getType()]) ? LogicOperator::MAP[$token->getType()] : null;
    
        if (null === $operator) {
            $this->throwSyntaxError($lexer, ...array_keys(LogicOperator::MAP));
        }
    
        $lexer->next();
        
        return new LogicOperatorExpression($operator);
    }
    
}