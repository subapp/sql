<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ParserInterface;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Uncover
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Uncover extends AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        return $this->uncover($this->getExpressionParser($processor), $processor);
    }

    /**
     * @param ParserInterface $parser
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function uncover(ParserInterface $parser, ProcessorInterface $processor)
    {
        $lexer = $processor->getLexer();
        $expression = null;

        $this->shift(Lexer::T_OPEN_BRACE, $lexer);

        if ($this->isOpenBrace($lexer)) {
            $this->uncover($parser, $processor);
        }
var_dump($this->getStringLength($lexer, 10));
        $expression = $parser->parse($lexer, $processor);
        $this->shift(Lexer::T_CLOSE_BRACE, $lexer);

        return $expression;
    }

}