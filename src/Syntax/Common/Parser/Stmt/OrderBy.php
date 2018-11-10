<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\OrderBy as OrderByExpression;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class OrderBy
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class OrderBy extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|OrderByExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $orderBy = new OrderByExpression();
        
        
        return $orderBy;
    }
    
}