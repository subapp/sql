<?php

namespace Subapp\Sql\Parser\Common;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Common\From;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Parser\AbstractParser;
use Subapp\Sql\Parser\ProcessorInterface;

/**
 * Class FromParser
 * @package Subapp\Sql\Parser\Common
 */
class FromParser extends AbstractParser
{
    
    /**
     * @inheritdoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->match(Lexer::T_FROM, $lexer);
        $this->matchIf(Lexer::T_GRAVE_ACCENT, $lexer);
        $this->match(Lexer::T_IDENTIFIER, $lexer);
        
        $expression = new From();
        $expression->{'table'} = $lexer->getTokenValue();
        
        $this->matchIf(Lexer::T_GRAVE_ACCENT, $lexer);
        
        return $expression;
    }
    
}