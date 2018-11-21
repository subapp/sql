<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\NodeInterface;
use Subapp\Sql\Ast\Stmt\Limit as LimitExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Limit extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return NodeInterface|LimitExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $limit = new LimitExpression();
        $literal = $this->getLiteralParser($processor);
        
        $this->shift(Lexer::T_LIMIT, $lexer);
        
        $value = $literal->parse($lexer, $processor);
        
        if ($lexer->toToken(Lexer::T_COMMA)) {
            $limit->setOffset($value);
            $limit->setLength($literal->parse($lexer, $processor));
        } else {
            $limit->setLength($value);
        }
        
        return $limit;
    }
    
}