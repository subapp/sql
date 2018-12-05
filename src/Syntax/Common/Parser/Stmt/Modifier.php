<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Modifiers;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Modifier
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Modifier extends AbstractDefaultParser
{
    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $modifier = new Modifiers();

        while ($lexer->toToken(Lexer::T_MODIFIER)) {
            $modifier->add($lexer->getTokenValue());
        }

        return $modifier;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_MODIFIER;
    }

}