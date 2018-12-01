<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Insert
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Insert extends AbstractDefaultParser
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {

    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_INSERT;
    }

}