<?php

namespace Subapp\Sql\Parser\Statement;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Statement\Select;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Parser\AbstractParser;
use Subapp\Sql\Parser\ProcessorInterface;

/**
 * Class SelectParser
 * @package Subapp\Sql\Parser\Statement
 */
class SelectParser extends AbstractParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $expression = new Select();
        
        while (!$lexer->isNext(Lexer::T_FROM) && $lexer->isValid()) {
            $lexer->next();
        }
        
        $expression->{'from'} = $processor->getParser('common.from_parser')->parse($lexer, $processor);
        
        return $expression;
    }
    
}