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

        return new AliasExpression(null, $parser->parse($lexer, $processor));
    }

    /**
     * @param ProcessorInterface $processor
     * @param ExpressionInterface $expression
     * @return AliasExpression|ExpressionInterface
     */
    public function wrapExpression(ProcessorInterface $processor, ExpressionInterface $expression)
    {
        $alias = $this->parse($processor->getLexer(), $processor);

        $alias->setExpression($expression);

        return $alias;
    }

}