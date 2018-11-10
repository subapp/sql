<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Identifier;
use Subapp\Sql\Ast\Literal;
use Subapp\Sql\Ast\QuoteIdentifier;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Alias
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Alias extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|Identifier|QuoteIdentifier|Literal
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shiftIf(Lexer::T_AS, $lexer);

        $parser = null;

        switch (true) {
            case $this->isIdentifier($lexer):
                $parser = $this->getIdentifierParser($processor);
                break;
            case $lexer->isNext(Lexer::T_STRING):
                $parser = $this->getLiteralParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'String', 'Identifier');
        }

        return $parser->parse($lexer, $processor);
    }

}