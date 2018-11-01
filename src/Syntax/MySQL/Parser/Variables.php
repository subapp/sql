<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Ast\Variables as ArgsExpression;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\MySQL;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Variables
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Variables extends MySQL\Parser\AbstractMySQLParser
{

    /**
     * @param LexerInterface     $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|ArgsExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $variables = new ArgsExpression();
        $parser = $this->getComplexParser($processor);

        do {
            // parse any Expression comma-separated
            $expression = $parser->parse($lexer, $processor);

            if ($this->isAlias($lexer)) {
                // store reference to object
                $tmp = $expression;

                // parse Alias expression
                $expression = $this->getAliasParser($processor)->parse($lexer, $processor);
                $expression->setExpression($tmp);
            }

            $variables->append($expression);
        } while ($lexer->toToken(Lexer::T_COMMA));

        return $variables;
    }

}