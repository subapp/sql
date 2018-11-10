<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Embrace;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class SubSelect
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class SubSelect extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Embrace
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $embrace = new Embrace();

        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $embrace->setInner($processor->getParser('stmt.select_statement')->parse($lexer, $processor));
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        return $embrace;
    }

}