<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Identifier as IdentifierExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Identifier
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Identifier extends AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|IdentifierExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $identifier = new IdentifierExpression();
        $this->match(Lexer::T_IDENTIFIER, $lexer);
        
        $identifier->setIdentifier($lexer->getTokenValue());
        
        return $identifier;
    }
    
}