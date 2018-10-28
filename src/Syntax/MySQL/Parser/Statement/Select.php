<?php

namespace Subapp\Sql\Syntax\MySQL\Parser\Statement;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\AbstractParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement
 */
class Select extends AbstractParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Ast\Statement\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $expression = new Ast\Statement\Select();
        
        while (!$lexer->isNext(Lexer::T_FROM) && $lexer->isValid()) {
            $lexer->next();
        }
    
        $expression->setFrom($processor->getParser('parser.from')->parse($lexer, $processor));
        
        return $expression;
    }
    
}