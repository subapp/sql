<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\AbstractParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Syntax\MySQL\Parser\Common
 */
class From extends AbstractParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->match(Lexer::T_FROM, $lexer);
        $this->matchIf(Lexer::T_GRAVE_ACCENT, $lexer);
        $this->match(Lexer::T_IDENTIFIER, $lexer);
        
        $expression = new Ast\From();
        $expression->setTable($lexer->getTokenValue());
        
        $this->matchIf(Lexer::T_GRAVE_ACCENT, $lexer);
        
        return $expression;
    }
    
}