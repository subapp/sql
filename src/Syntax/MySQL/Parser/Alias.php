<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\Alias as AliasExpression;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Alias
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Alias extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface|AliasExpression
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $this->shiftIf(Lexer::T_AS, $lexer);

        $identifier = $this->getIdentifierParser($processor)->parse($lexer, $processor);

        return new AliasExpression(null, $identifier);
    }

}