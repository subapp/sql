<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Identifier extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|IdentifierExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_IDENTIFIER, $lexer);
        
        return new IdentifierExpression($lexer->getTokenValue());
    }
    
}