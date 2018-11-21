<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Parameter as ParameterExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Parameter
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Parameter extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|ParameterExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parameter = new ParameterExpression();
        
        switch (true) {
            case $lexer->toToken(Lexer::T_QUESTION):
                $parameter->setType(ParameterExpression::UNNAMED);
                break;
            case $lexer->toToken(Lexer::T_COLON):
                $this->shift(Lexer::T_IDENTIFIER, $lexer);
                $parameter->setType(ParameterExpression::NAMED);
                $parameter->setName($lexer->getTokenValue());
                break;
            default:
                $this->throwSyntaxError($lexer, Lexer::T_COLON, Lexer::T_QUESTION);
        }
        
        return $parameter;
    }
    
}