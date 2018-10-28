<?php

namespace Subapp\Sql\Syntax\MySQL\Parser\Func;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\AbstractParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class TrimFunctionParser
 * @package Subapp\Sql\Syntax\MySQL\Parser\Func
 */
class TrimParser extends AbstractParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
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
//    public function getName()
//    {
//        return 'function.trim';
//    }
    
}