<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Embrace as EmbraceExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class EmbraceExpression
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Embrace extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|EmbraceExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $expression = $this->getComplexParser($processor)->parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);
        
        return new EmbraceExpression($expression);
    }

}