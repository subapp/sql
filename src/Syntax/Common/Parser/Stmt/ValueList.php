<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\Arguments;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class ValueList
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class ValueList extends Arguments
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_VALUES, $lexer);
        $this->shift(Lexer::T_OPEN_BRACE, $lexer);
        $node = parent::parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        return $node;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_VALUES;
    }

}