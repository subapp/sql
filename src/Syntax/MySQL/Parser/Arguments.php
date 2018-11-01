<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Variables as ArgsExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Arguments
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Arguments extends MySQL\Parser\AbstractMySQLParser
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