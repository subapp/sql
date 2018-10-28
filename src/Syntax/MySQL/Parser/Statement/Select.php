<?php

namespace Subapp\Sql\Syntax\MySQL\Parser\Statement;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Select
 * @package Subapp\Sql\Syntax\MySQL\Parser\Statement
 */
class Select extends MySQL\Parser\AbstractMySQLParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return \Subapp\Sql\Ast\ExpressionInterface|Ast\Statement\Select
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $expression = new Ast\Statement\Select();
        
        $expressions = $this->getSelectExpressionParser($processor)->parse($lexer, $processor);
        
        while (!$lexer->isNext(Lexer::T_FROM) && $lexer->isValid()) {
            $lexer->next();
        }
    
        $expression->setFrom($this->getExpressionFromParser($processor)->parse($lexer, $processor));
        
        $expression->{'_identifiers'} = $expressions;
        
        return $expression;
    }
    
}