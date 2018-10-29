<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class QuotedIdentifier
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class QuotedIdentifier extends Identifier
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|IdentifierExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->match(Lexer::T_GRAVE_ACCENT, $lexer);
        $identifier = parent::parse($lexer, $processor);
        $this->match(Lexer::T_GRAVE_ACCENT, $lexer);
        
        return $identifier;
    }
    
}