<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\GroupBy as GroupByExpression;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class GroupBy extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|GroupByExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $groupBy = new GroupByExpression();
        
        
        return $groupBy;
    }
    
}