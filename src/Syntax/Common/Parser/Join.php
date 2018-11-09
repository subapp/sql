<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Join as JoinExpression;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Join
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Join extends AbstractDefaultParser
{
    
    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|JoinExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $join = new JoinExpression();
        
        return $join;
    }
    
}