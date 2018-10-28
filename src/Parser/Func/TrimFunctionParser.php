<?php

namespace Subapp\Sql\Parser\Func;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Parser\AbstractParser;

/**
 * Class TrimFunctionParser
 * @package Subapp\Sql\Parser\Func
 */
class TrimFunctionParser extends AbstractParser
{
    
    /**
     * @param LexerInterface $lexer
     */
    public function parse(LexerInterface $lexer)
    {
        // @todo for test...
        $this->match(Lexer::T_IDENTIFIER, $lexer);
        $this->match(Lexer::T_OPEN_BRACE, $lexer);
        $this->match(Lexer::T_STRING, $lexer);
        $this->match(Lexer::T_CLOSE_BRACE, $lexer);
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'function.trim';
    }
    
}