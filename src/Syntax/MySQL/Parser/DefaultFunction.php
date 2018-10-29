<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class DefaultFunction
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class DefaultFunction extends AbstractFunction
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $function = parent::parse($lexer, $processor);

        $this->match(Lexer::T_OPEN_BRACE, $lexer);

        // parse arguments...

        $this->match(Lexer::T_CLOSE_BRACE, $lexer);

        return $function;
    }

}