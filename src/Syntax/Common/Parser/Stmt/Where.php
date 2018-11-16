<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Stmt\Where as WhereExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Where
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Where extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|WhereExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_WHERE, $lexer);

        $where = new WhereExpression();
        $conditions = $this->getConditionalParser($processor)->parse($lexer, $processor);
        
        // @todo hardcore wrap conditions into where
        $where->asBatch($conditions->toArray());

        return $where;
    }
    
}