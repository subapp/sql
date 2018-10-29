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
                $expression = $this->getArithmeticParser($processor)->parse($lexer, $processor);
                break;

            case $this->isFunction($lexer):
                $expression = $this->getOrdinaryFunctionParser($processor)->parse($lexer, $processor);
                break;
                
            case $this->isFieldPath($lexer):
                $expression = $this->getFieldPathParser($processor)->parse($lexer, $processor);
                break;

            case $this->isLiteral($lexer):
                $expression = $this->getLiteralParser($processor)->parse($lexer, $processor);
                break;

            default:
                $this->throwSyntaxError($lexer, 'Literal', 'FieldPath', 'Function', 'MathExpression');
        }

        return $expression;
    }

}