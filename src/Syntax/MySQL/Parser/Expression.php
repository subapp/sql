<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Expression
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Expression extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $expression = null;

        /** @var Lexer $lexer */

        switch (true) {
            case $this->isMathExpression($lexer):
                die(var_dump("isMathExpression " . $this->renderToToken($lexer, Lexer::T_COMMA)));
                break;

            case $this->isFunction($lexer):
                $expression = $this->getDefaultFunctionParser($processor)->parse($lexer, $processor);

            case $this->isFieldPath($lexer):
                $expression = $this->getFieldPathParser($processor)->parse($lexer, $processor);
                break;

            case $this->isLiteral($lexer):
                $expression = $this->getLiteralParser($processor)->parse($lexer, $processor);
                break;

            default:
                $this->throwSyntaxError($lexer, 'expression like: table.id', '123', '"string"', 'COUNT()', '(123 + 456) * SUM(table.qty)');
        }

        var_dump($expression);

        return $expression;
    }

}