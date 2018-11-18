<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Join as JoinExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Join
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Join extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|JoinExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $join = new JoinExpression();
        
        switch (true) {
            case $lexer->toToken(Lexer::T_INNER):
                $join->setJoinType(JoinExpression::INNER);
                break;
            case $lexer->toToken(Lexer::T_LEFT):
                $join->setJoinType(JoinExpression::LEFT);
                break;
            case $lexer->toToken(Lexer::T_RIGHT):
                $join->setJoinType(JoinExpression::RIGHT);
                break;
            default:
                $this->throwSyntaxError($lexer, Lexer::T_INNER, Lexer::T_LEFT, Lexer::T_RIGHT);
        }
        
        $this->shift(Lexer::T_JOIN, $lexer);
        
        $join->setLeft($this->getVariableParser($processor)->parse($lexer, $processor));
        
        switch (true) {
            case $lexer->toToken(Lexer::T_ON):
                $join->setConditionType(JoinExpression::ON);
                $join->setCondition($this->getConditionalParser($processor)->parse($lexer, $processor));
                break;
            case $lexer->toToken(Lexer::T_USING):
                $join->setConditionType(JoinExpression::USING);
                $this->shift(Lexer::T_OPEN_BRACE, $lexer);
                $join->setCondition($this->getArgumentsParser($processor)->parse($lexer, $processor));
                $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
                break;
            default:
                $this->throwSyntaxError($lexer, Lexer::T_ON, Lexer::T_USING);
        }
        
        return $join;
    }
    
}