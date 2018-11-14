<?php

namespace Subapp\Sql\Syntax\Common\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Arguments as ArgsExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\Common;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Syntax\Common\Parser
 */
class Arguments extends Common\Parser\AbstractDefaultParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|ArgsExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $variables = new ArgsExpression();
        $parser = $this->getComplexParser($processor);

        if (!$lexer->isNext(Lexer::T_CLOSE_BRACE)) {
            do {
                $variables->append($parser->parse($lexer, $processor));
            } while ($lexer->toToken(Lexer::T_COMMA));
        }

        return $variables;
    }

}