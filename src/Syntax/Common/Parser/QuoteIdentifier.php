<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\QuoteIdentifier as QuoteIdentifierExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class QuotedIdentifier
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class QuoteIdentifier extends Identifier
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|QuoteIdentifierExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shiftIf(Lexer::T_GRAVE_ACCENT, $lexer);
        $identifier = parent::parse($lexer, $processor);
        $this->shiftIf(Lexer::T_GRAVE_ACCENT, $lexer);
        
        return new QuoteIdentifierExpression($identifier);
    }
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::PARSER_QUOTE_IDENTIFIER;
    }
    
}