<?php

namespace Subapp\Sql\Syntax\Common\Parser\Stmt;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common\Parser\AbstractDefaultParser;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Into
 * @package Subapp\Sql\Syntax\Common\Parser\Stmt
 */
class Into extends AbstractDefaultParser
{

    /**
     * @inheritDoc
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shift(Lexer::T_INTO, $lexer);

        $parser = null;

        switch (true) {
            case $this->isIdentifier($lexer):
                $parser = $this->getIdentifierParser($processor);
                break;
            case $this->isQuoteIdentifier($lexer):
                $parser = $this->getQuoteIdentifierParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Identifier', 'QuoteIdentifier');
        }

        return $parser->parse($lexer, $processor);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return self::PARSER_STMT_INTO;
    }

}