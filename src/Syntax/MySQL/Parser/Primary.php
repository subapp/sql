<?php

namespace Subapp\Sql\Syntax\MySQL\Parser;

use Subapp\Lexer\LexerInterface;
use Subapp\Sql\Ast\ExpressionInterface;
use Subapp\Sql\Lexer\Lexer;
use Subapp\Sql\Syntax\ProcessorInterface;

/**
 * Class Primary
 * @package Subapp\Sql\Syntax\MySQL\Parser
 */
class Primary extends AbstractMySQLParser
{

    /**
     * @param LexerInterface $lexer
     * @param ProcessorInterface $processor
     * @return ExpressionInterface
     */
    public function parse(LexerInterface $lexer, ProcessorInterface $processor)
    {
        $parser = null;

        switch (true) {
            case $this->isFieldPath($lexer):
                $parser = $this->getFieldPathParser($processor);
                break;
            case $this->isIdentifier($lexer):
                $parser = $this->getFieldPathParser($processor);
                break;
            case $this->isLiteral($lexer):
                $parser = $this->getLiteralParser($processor);
                break;
            case $this->isMathExpression($lexer):
                $parser = $this->getArithmeticParser($processor);
                break;
            default:
                $this->throwSyntaxError($lexer, 'Identifier', 'Literal', 'FieldPath', 'MathExpression');
        }

        return $parser->parse($lexer, $processor);
    }

}